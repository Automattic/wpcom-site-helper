# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.2.0-alpha] - unreleased

This is an alpha version! The changes listed here are not final.

### Added
- RTC: add a jetpack_rtc_blocked Tracks event recorded when a client is turned away because the per-room contributor limit was reached.
- RTC: add a jetpack_rtc_connection_error Tracks event recorded on a genuine (non-limit) sync connection error; the per-room-limit case is skipped to avoid double-counting with jetpack_rtc_blocked.
- RTC: add a jetpack_rtc_join Tracks event recording transport and contributors when a client joins a room

### Changed
- Add richer connection logging: channel path, JWT age at disconnect, wasClean flag, and reconnect attempt events.
- Internal: No longer require automattic/jetpack-changelogger as a per-project dev dependency.
- RTC: Default collaboration to off, drive the Gutenberg 23.8 experiment from the Settings > Writing toggle, and preserve the choice of sites that had already opted in.
- RTC: Re-enable real-time collaboration by default on WP.com sites.
- RTC: Re-enable RTC by default on WoW sites
- Update package dependencies.

### Removed
- Minimum supported PHP version is now 7.4.
- RTC: remove the pinghub.rtc.* analytics pixels (room_peers, conn_open, conn_close_code, conn_err, jwt_fetch, jwt_fetch_error, send_drop), now superseded by the jetpack_rtc_* Tracks events. The generic pinghub.* pixels and the logConnectionEvent() logging are unchanged.
- RTC: Remove the welcome modal.

### Fixed
- PingHub: allow local (unconnected) users to obtain a token via the site blog token, requesting the /wpcom/v2/ signing endpoint with the correct API base
- RTC: Fix PingHub WebSocket chunking so messages larger than 1024 bytes reassemble correctly. Each chunk now carries the room tag, instead of tagging the whole message once before chunking which left later chunks untagged and dropped on receive.
- RTC: source Tracks event post and user context from the server-injected config so post_id, post_type, and wp_user_id are populated on all transports and even when an event fires before the editor and awareness have initialized.

## 0.1.0 - 2026-04-09
### Added
- Initial version. [#47713]

### Changed
- Add RTC-specific pixel beacons (`pinghub.rtc.*`) alongside existing shared beacons for dedicated RTC dashboarding, and add new beacons for JWT fetch latency/errors and send drops. [#47772]
- Disable RTC in site editor [#47681]
- Move RTC notices (welcome notice, room-limit enforcement, join requests) from jetpack-mu-wpcom into the rtc package. [#47964]
- Multiplex all PingHub rooms over a single WebSocket connection per editing session, reducing connection count from N to 1. [#47994]
- Update package dependencies. [#47874] [#47890]

### Fixed
- Avoid endless PingHub reconnection loop on persistent WebSocket or JWT fetch errors [#47864]
- Defer reconnect backoff reset until WebSocket connection has been stable for 30 seconds [#47901]
- Disable RTC for super admins who are not members of the blog to prevent exposing their presence during support sessions. [#47867]
- Inline the keepalive Web Worker as a Blob URL so it works on sites that load scripts from a different origin. [#48024]
- PingHub: support root/comment entity type so collaborative notes sync in real time over WebSockets [#47833]
- Skip attachment entities in PingHub provider to avoid excessive WebSocket connections on media-heavy sites [#47917]

[0.2.0-alpha]: https://github.com/Automattic/jetpack-rtc/compare/v0.1.0...v0.2.0-alpha
