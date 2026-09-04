# Changelog

## 10.0.0-alpha - unreleased

This is an alpha version! The changes listed here are not final.

### Added
- Add a check for sites with legacy feature gating.
- Add a `wpcomsh php83-plugin-patch mega_main_menu` CLI command that removes the duplicate `static $theme_option_file` declaration triggering a "Duplicate declaration of static variable" fatal error under PHP 8.3+.
- Add REST endpoint that reports the active Gutenberg plugin version, gated by a WP option.
- Add stats wp abbilities
- Add Titan Mail Premium and Ultra product constants to WPCOM_TITAN_MAIL_PRODUCTS for feature detection
- Agents Manager: Add Sidebar Preservation On Load Mechanism
- Bilmur: add opt-in data-site-v attribute to the RUM meta tag via a new wpcomsh_bilmur_site_v filter
- CLI: generalize `wpcomsh php83-plugin-patch` into a table-driven patcher for PHP 8.3+ duplicate-static-variable fatals and add a `php83-theme-patch` counterpart. Covers the dash-slug mega-main-menu folder, ninja-forms, wiziapp, thegem-blocks, deepcore, malina-elements, sfwd-lms, cp-addons-for-vc and ingeniofy plugins, plus the SecondLine (tusant/gumbo/dixie/satchmo/bolden) and Select-Themes (hazel/hazel1/alma/maple/rhythm/architek) theme families.
- CLI: php83 patchers round 2 — accept any known folder slug as the command argument, add a `--force` escape hatch for pending-but-uninstallable updates, support alternative replacement sets per patch (CRLF/LF vendor variants), extend the deepcore patch to all three duplicated static counters, and add the skudo and larch-1 themes to the Select-Themes family.
- CLI: php83 patchers round 3 — LF variants for the SecondLine theme patch (newer licensed builds ship Unix line endings), and a deepcore-widget patch for the duplicated static counters in the Elementor magazine widget's render(), which only compiles on pages using that widget.
- Customize the WordPress fatal error screen with WordPress.com support links.
- Enable wp-admin JS error reporting on sites participating in the `gutenberg-react-19` experiment.
- Fatal-error screen: log the offending extension's signature (kind, slug, version, WordPress core, PHP) to wpcom logstash via WPCOMSH_Log, deduped so a persistent fatal emits one record rather than one per visitor, so MC dashboards can aggregate the most common breakages.
- Fatal error: log recovery-mode email dispatches (sent, disabled, no recipient) and post-login recovery-mode entry to logstash.
- Fatal error: tag log events with request_kind/path/method and dedup per (signature, kind) so a site-wide fatal surfaces as one row per affected surface.
- Help Center: Show the contextual CTA in wp-admin.
- On the WordPress beta track, ignore the Gutenberg plugin when it is older than the Gutenberg version bundled in the running WordPress core, so the site uses the newer core-bundled Gutenberg.
- Plugin Conflicts Guardian: control the rollout percentage from wpcomsh.
- Premium Analytics: Add an "Any feedback?" action to the dashboard header.
- Premium Analytics: Add an Ads dashboard section showing WordAds earnings and performance.
- Premium Analytics: Add a year dropdown to the Year in review (Highlights) widget header, defaulting to the current year, and drop its metric selector so the card always shows posts, words, likes, and comments.
- Premium Analytics: Add referrer groups that open folded and expand on demand in the Referrers report.
- Premium Analytics: add total and per-post image counts to the Annual insights report.
- Premium Analytics: enable the bundled dashboard on Atomic sites carrying the jetpack-premium-analytics sticker.
- Premium Analytics: Expose the dashboard opt-in as a site setting, so administrators can turn the dashboard on and off through the site settings API.
- Premium Analytics: Send dashboard feedback on to Jetpack support, so it is not lost when analytics are blocked.
- Premium Analytics: Show all-time views, visitors, and posts in the default Insights layout.
- Profile Settings: add a link to manage your username on WordPress.com to the username row on wp-admin/profile.php.
- Report recovery-mode state to wpcom (via /sites/{blog_id}/recovery-mode-status) so wpcom-side consumers can surface "needs recovery" and related states for sites that have hit a fatal error.
- Social: Register the social-image-focal-point feature flag for WPCOM sites.
- Stats: Add a Popular hours widget showing the busiest hour and its daily average views.
- Stats: link the post list views column to the analytics post detail page when the new dashboard is enabled.
- Sync the `SEO_ADMIN_UI` feature flag.
- Sync the `SOCIAL_ADMIN_UI_V2` feature flag.
- WordAds: Add support for the wordads-free-access sticker.
- WPCOM Features: Add POSTS_TO_PODCAST_TIER_{1,2,3} features mapped to Personal+, Premium+, and Business+ plans respectively. Mirrors the wpcom-side change that gates the Posts-to-Podcast endpoint and its monthly generation quota.
- Wpcomsh fatal-error: log a `wpcomsh_fatal_deactivate` event when an admin clicks the Deactivate button on the fatal-error screen, so we can tell which fatals lead to user-initiated deactivations. Both the deactivate event and the existing `wpcomsh_fatal_signature` event now also carry `properties.atomic_site_id` for site-axis grouping.
- Wpcomsh fatal-error: route the screen's "Enter recovery mode" link through a first-party redirect endpoint that logs a `wpcomsh_fatal_recovery` event before forwarding to a freshly-generated core recovery URL, so we can measure screen-originated recovery clicks alongside the existing signature and deactivate events without conflating them with email-originated entries.
- WPCOM_Features: add `PODCASTING` feature and map it to Premium-and-higher plans plus all Jetpack-connected sites.
- Write: Ask writers one question about their experience after their first post, with an optional comment.

### Changed
- Agents Manager: Extract into its own package from jetpack-mu-wpcom
- AI Launchpad: bundle the jetpack-wp-build-polyfills dependency used by the new launchpad admin page.
- Allow the renamed gutenberg-guidelines experiment alongside the existing gutenberg-content-guidelines experiment on Atomic sites.
- Charts: update chart grid, axis and label colors immediately when the theme changes.
- Connection: Cache the Atomic Persistent Data instance and connection-owner lookup per request to reduce duplicate DB queries.
- Copy a site: enable for all paid Atomic-capable plans (Personal, Premium, and Business or higher), mirroring WPCOM.
- Enable wp-admin JS error reporting on 2% of sites, to keep up with the React 19 experiment rollout.
- Enable wp-admin JS error reporting on 5% of sites, to keep up with the React 19 experiment rollout.
- Enable wp-admin JS error reporting on 10% of sites, to keep up with the React 19 experiment rollout.
- Fatal error screen: extend telemetry dedup windows from 5 minutes to 1 hour.
- Forms, Stats: CSV export will now process data containing backslashed quotation marks as specified in the relevant standard.
- General: update composer.lock files.
- General: Update minimum WordPress version to 6.9.
- General: Update minimum WordPress version to 7.0.
- Guidelines CPT meta now syncs via jetpack_sync_post_meta_whitelist filter with explicit meta keys instead of prefix matching.
- Gutenberg: Enable wp-admin JS error reporting on 1% of Atomic sites.
- Internal: No longer require automattic/jetpack-changelogger as a per-project dev dependency.
- Internal: regenerate composer.lock to pick up the podcast package's new automattic/jetpack-connection dependency.
- Load only when desired.
- Make the help and Ask AI admin bar nodes available from the admin-bar REST endpoints, with the label, icon and destination a client needs.
- Move Custom CSS to Devcie Detection
- Newspack Blocks: Update the Blog Posts and Posts Carousel blocks to Newspack Blocks 4.30.3.
- Omnibar: point the WordPress.com sites and account links to the my.wordpress.com subdomain.
- Permalinks: make the Settings → Permalinks page available on all sites and remove the plan-based gating and upsell.
- Plan expiry notices: sites on the new expiry notices no longer see the legacy plan-renewal admin notice.
- Plugin Conflicts Guardian: raise the Atomic rollout to 2% of sites.
- Podcast: split the Distribution directories into Automatic and Manual submission, explain why a disabled button is disabled, and link to your Pocket Casts show once it is live.
- Podcast: update composer.lock.
- Podcasting: flip jetpack_podcast_untangle globally on Atomic so every WoA site moves to the new jetpack-podcast package (parallel to the wpcom-side flip already live on Simple).
- Podcasting: only load the legacy at-pressable-podcasting plugin when the new jetpack-podcast package is not taking over the feature.
- Podcasting: stand down the legacy at-pressable-podcasting plugin when the new Jetpack podcast package owns the feature.
- Premium Analytics: Divide a widget's metrics with lines instead of boxing each one.
- Premium Analytics: Even out the header spacing on the post detail page to match the video page.
- Premium Analytics: label the traffic chart's time axis by the size of the bucket behind the data, and name each bar's period in full in its tooltip.
- Premium Analytics: limit dashboard customization to moving and resizing widgets.
- Premium Analytics: Match the post and video page headers to the layout used across the rest of Analytics.
- Premium Analytics: Move the Ads date range into the WordAds card's own header, and drop the section header's date filter.
- Premium Analytics: Name the dates a comparison covers in the dashboard header, instead of "Previous period", drop the weekdays from ranges longer than a week, and leave the year off ranges that sit inside the current one.
- Premium Analytics: Open the Authors, Clicks and UTM reports folded to their top-level groups, and move the drill-down control to the right of the row title.
- Premium Analytics: rename the Top pages CSV comparison column to "Views (Previous Period)" and move it after the primary columns.
- Premium Analytics: Retitle the Popular post card to "Most popular post in the last 12 months" and pin it to the last 12 months.
- Premium Analytics: Shorten the Popular post card title so it survives a narrow dashboard cell.
- Premium Analytics: show the latest emails sent as a plain list of subjects and rates.
- Profile Settings: reword the WordPress.com links on wp-admin/profile.php to "Edit account settings on WordPress.com".
- Pull in the latest jetpack-podcast package (adds the Podcast Episode block, gated behind the jetpack_podcast_untangle filter; no behavior change while off).
- Recovery-mode sync: include per-extension error info so wpcom-side consumers can surface what fataled.
- Redesign the fatal error screen: identify the likely-cause plugin, offer admins a one-click signed deactivation URL, surface recovery mode when available, and link to WordPress.com support.
- Refactored URL linkification to use WP_HTML_Tag_Processor for more robust HTML parsing.
- Remove unneeded development and documentation files from the published plugin.
- Return site purchases in a declared shape, with billing-derived auto-renew state behind accessors.
- Social: Enable message templates feature for WPCOM sites.
- Stop serving COLOURLovers background images now that COLOURLovers support has been discontinued.
- Sync features list with WPCOM - add Student plan with Business plan feature parity.
- Sync features list with WPCOM - removing social unified UI feature flag.
- Tested up to WordPress 7.0.
- Tested up to WordPress 7.1.
- Update composer.lock files.
- Updated composer.lock for the Podcast package's new jetpack-admin-ui dependency.
- Updated composer.lock to pick up jetpack-plans transitively via jetpack-podcast.
- Updated composer.lock to pull in the new jetpack-podcast wp-build scaffold transitively (via jetpack-mu-wpcom).
- Updated package dependencies.
- Update package dependencies.
- Update wc-calypso-bridge to 2.11.8.
- Update wp-php-toolkit dependencies.
- WP.com Error Reporting: delegate all decisions to host-specific filters
- WP.com Error Reporting: use direct fetch with no CORS preflight
- wpcom-fatal-error: rename the fatal-error screen's "Likely cause" heading to "Suspected plugin" / "Suspected theme", identify theme-origin fatals so the card shows the theme's name / version / description, and surface Error details + Environment (WordPress / PHP / theme / server) as always-visible sections below the card.
- wpcom-fatal-error: rewrite the admin recovery-mode email — WordPress.com-branded HTML matching the fatal-error screen, with the site name, suspected plugin/theme card, action links into wp-admin, and separate Error details + Environment sections.
- wpcom-features: make BIG_SKY the single paid-plan eligibility gate for Big Sky / AI sidebar; remove BIG_SKY_EXISTING_SITE; add Starter to GLOBAL_STYLES.
- WPCOMSH_Log: add `unsafe_direct_log_logstash()` for records that need their own /logstash `feature` bucket; route fatal-error signatures through it under feature `atomic_extension_conflict` (severity `critical`).
- WPCOMSH_Log: drop the unused top-level `siteurl` field from /logstash payloads (the receiver doesn't consume it). Fatal-error signatures now pass `site_url` as a property instead, so it lands at `properties.site_url` in Kibana alongside the other indexed fields.

### Removed
- Podcast: Remove the Atomic module opt-in and force-activation, so the module follows the site's own setting.
- Podcasting: remove the at-pressable-podcasting bridge now that the jetpack-podcast package owns the experience on every WoA site.
- Remove COLOURLovers UI feature
- Revert the Jetpack-side changes that re-enabled X (Twitter) sharing in Jetpack Social.
- Subscriptions: Remove the transitional Subscribers announcement page from the Jetpack menu.

### Fixed
- Admin bar: don't treat the default favicon fallback as a site icon
- Admin bar: Fix site name and wpcom account menu item height.
- Admin color schemes: render the checked checkbox and radio marks in white, matching core.
- Admin color schemes: Stop labelling the Fresh scheme "Default", which duplicated the Default (Modern) entry on WordPress 7.0.
- Admin dashboards: Keep the page header and content in view when the wp-admin menu is taller than the window.
- Charts: Place line and area chart date ticks on the site's time zone boundaries, name the hour in tooltips on hourly data, and read hour labels in the site's own locale rather than a forced 12-hour clock.
- Connection: Update wording for some connection error notices.
- Crowdsignal: suppress the onboarding and "link your account" notices that cluttered the Plugins page on WoA sites after activation.
- Custom Colors: Scope Customizer colors to the editor content so they no longer leak into the block editor UI (e.g. the sidebar's Categories panel).
- Custom Colors: stop injecting Customizer colors into the block editor so they no longer leak into the editor UI
- Fatal error screen: ensure enough free memory before rendering (raising the limit when headroom is short, or falling back to core's screen) so the screen no longer exhausts memory mid-render on a near-limit request and masks the real error in logs.
- Fixed a regression added on https://github.com/Automattic/jetpack/pull/48286
- Google Fonts: stop force-activating the module on every request, and stop hiding it from the classic Jetpack modules screen, so it is no longer auto-enabled by default and can be toggled off and back on.
- Launch: Do not show the pre-launch confirmation modal on trial sites, which still need to choose a plan and domain.
- Phan: Address PhanPluginDuplicateConditionalNullCoalescing violations.
- Plugin Conflicts Guardian: fix the staged rollout so the pre-flight plugin check reaches its intended share of sites.
- Podcast: Scope the generated episodes list to the posts the current user can edit, matching the Posts screen.
- Podcast dashboard: keep the chart tooltip under sticky and fixed page elements.
- Premium Analytics: Compare a date range against a previous month or year of the same length, so the percentages no longer measure 30 days against 29. Whole calendar months still compare month to month.
- Premium Analytics: Compute date-filter day boundaries in the site's timezone, so visitors west of the site timezone no longer get stretched ranges or wrong chart buckets.
- Premium Analytics: Drop the Last 24 hours range from the WordAds card, which has no hourly data to chart.
- Premium Analytics: fix a stray label stacked at the left edge of a chart's time axis after hiding a series from the legend, or when the chart mixes labelled bars with dated ones or compares two periods, and stop a labelled bar's tooltip reading "Invalid Date".
- Premium Analytics: Fix the Subscribers summary help text to describe the cumulative subscriber total the chart plots, not new subscribers.
- Premium Analytics: Include the last day of the selected range in the WordAds card.
- Premium Analytics: Keep the date picker on the range a chart drill-down applies.
- Premium Analytics: keep the full set of ticks on the traffic chart's time axis, which could thin out to two labels on longer date ranges.
- Premium Analytics: keep the year and the day on the traffic chart's time axis, which could previously skip the tick that named them, and stop the same label falling on two ticks in a row.
- Premium Analytics: keep the Year in review report link reachable.
- Premium Analytics: Link a subscriber's name to their subscriber details page.
- Premium Analytics: Post detail: stop the Post traffic layout from flashing when an email tab is opened directly, and show placeholder lines in the header while the title loads.
- Premium Analytics: print Tags & categories view counts in full, and list far more rows in its report.
- Premium Analytics: print the Annual insights words-per-post average whole, as the old Stats report does.
- Premium Analytics: Remove the quarterly chart interval option, which never changed the chart.
- Premium Analytics: Show abbreviated month names on chart x-axes in line and area views.
- Premium Analytics: Show a notice when a refresh fails, instead of silently leaving the previous numbers on screen.
- Premium Analytics: Show chart dates in the site's timezone and locale, and name the hour on hourly charts.
- Premium Analytics: Show the dashboard right away instead of a sync screen, and flag the Store section's numbers as incomplete while store data is still syncing.
- Premium Analytics: Stop applying hidden date comparisons in dashboard sections that do not offer the control.
- Premium Analytics: Stop the Ads chart interval menu offering buckets the WordAds chart cannot draw.
- Prevent Crowdsignal Forms from redirecting to its settings page on WoA sites after the Atomic transfer or a managed plugin version bump.
- Recurring Payments: restore the unconditional free-tier branch so free-plan sites keep paid newsletters and paid subscriptions.
- Restore custom-fonts typekit provider json files that shouldn't have been deleted.
- Site purchases: Fix a fatal error when a cached purchase row arrives in an unexpected shape.
- Site setup: Continue the wp-admin menu color behind the page frame on WordPress.com admin color schemes.
- Site visibility: Stop the site launch celebration modal from reappearing after saving Reading settings.
- Stats: Only show the admin bar link when the Stats module is active.
- Update wc-calypso-bridge to 2.11.7.

## 9.0.0 - 2026-04-09
### Added
- ActivityPub: Add new feature plugin, handling a custom sync event triggered when the plugin is activated. [#47346]
- Add a new feature to WPCOM_Features. [#46587] [#46629]
- Add autoloader check to prevent fatal errors when plugin is activated before composer install. [#46489]
- Add automattic/explat dependency. [#46066]
- Add domain features for woo_hosted plans. [#45687]
- Add feature flag for X connection support for Jetpack Social. [#47547]
- Add Real-time Collaboration as a WP.com plan feature. [#47483]
- Add SCAN_SELF_SERVE feature and expand SCAN access to all WoW plans. [#47187]
- Add Social unified UI feature flag. [#46061]
- Add Studio Sync features for lower plans. [#47966]
- Add support for user tokens in external storage. [#45303]
- Add Tracks events to theme screens. [#45587]
- Add warning when protected owner email is edited. [#46899]
- Disable outgoing and incoming pingbacks for staging sites. [#47628]
- Enable error logging for external storage. [#46795]
- Feature gating for payment-buttons and paypal-payment-buttons blocks. [#46536]
- Gutenberg RTC: Add PingHub provider for real-time collaboration WebSocket connections. [#47421]
- Gutenberg RTC: Add support for HTTP polling provider for real-time collaboration. [#47485]
- Gutenberg RTC: Connect to PingHub WebSocket directly using a server-generated JWT token, fixing real-time collaboration on custom-domain Atomic sites with third-party cookie restrictions. [#47556]
- Gutenberg RTC: Enable Real-Time Collaboration feature for sites with the REAL_TIME_COLLABORATION feature. [#47512]
- Holiday Snow: Add speed and hemisphere settings. [#46139]
- IDC: Add revalidation for IDCs. [#46268]
- Introduce Attachment pages setting in the media settings screen in wp-admin which controlls the `wp_attachment_pages_enabled` option. [#40590]
- RTC: HTTP-polling ramp up for WoW sites. [#47718]
- Support linking back to my.wordpress.com domain. [#46559]
- Tested up to WordPress 6.9. [#45571]
- Unregister the Gutenberg RTC setting on the Writing page if there are no RTC providers. [#47403]
- Update scssphp/scssphp dependency. [#45757]
- WordPress.com Reader: Add new feature plugin to force the activation of the new Reader module. [#46782]

### Changed
- ActivityPub: Include WebFinger handle alongside actor URI in plugin activation sync data. [#47402]
- Add 'mass-pagesposts-creator' to the plugin list we disallow for WoA sites. [#46050]
- Add form-webhooks feature support for WordPress.com plans. [#46059]
- Add support for 200GB legacy space through sticker. [#46920]
- Add support for flex plans. [#45492]
- Add/remove features to plans for a future experiment. [#46285]
- Adjust incompatible plugins list. [#46225] [#46286] [#46577] [#47280]
- Allow Atomic sites that have access to Global Styles to use Custom CSS. [#46632]
- Allow the content-guidelines Gutenberg experiment on Atomic sites instead of blanket-disabling all experiments. [#47581]
- Allow users with the UPLOAD_VIDEO_FILES feature to upload videos without VideoPress. [#46425]
- Code block: Remove active line highlight when block is unselected. [#45828]
- Code block: Remove experimental warning. [#45827]
- Custom post types: Ensure features remain available when theme support is added. [#45407]
- Dependencies: Update lock file to keep root requirements in sync. [#47418]
- Do not translate product names. [#43961]
- Enable Social unified UI v1 feature flag. [#47158]
- Gate for the Forms Integrations feature [#46829]
- Modify error logging. [#46919]
- Private site: Rename "Subscriber" role to "Viewer". [#45956]
- Remove header border-bottom from the admin page for a cleaner unified header appearance. [#47313]
- Remove unused `jetpack_show_wpcom_upgrades_email_menu` filter. [#47146]
- Removed Summer Special checks for backups on wpcomsh. [#46850]
- Replace use of confusing `esc_js` with `wp_json_encode`, or with nothing where it had no effect. [#46229]
- Tests: Ensure PHP 8.5 compatibility. [#45769]
- Update design of the sidebar upsell. [#47909]
- Update package dependencies. [#45478] [#45771] [#45958] [#46066] [#46082] [#46785] [#47021] [#47505] [#47799] [#47899]
- Update the feature gating for Donations, allowing conditional hiding based on a sticker. [#46472]
- WPCOM: Add logs, monitoring, performance hosting features. [#45622]
- WPCOM: Sync changes from class-wpcom-features.php. [#45675] [#45848] [#46576]

### Removed
- General: Update minimum WordPress version to 6.8. [#46801]
- JP Sitemaps: Remove sticker determination for XMLWriter. [#45527]
- Remove "Super Blank" plugin (`super-blank`) from list of incompatible plugins. [#46735]
- Remove JetBackup from incompatible plugins list. [#46618]
- Remove persistent data empty state logging. [#47250]
- Remove the dotcom command palette. [#46579]
- Remove unused constants. [#47241]
- RTC: Move implementation to generic package. [#47713]

### Fixed
- Add function_exists() check for wpcom_is_automattic_p2_site to prevent fatal errors when the function is undefined. [#47676]
- Admin Page: Restore border on header component. [#47425]
- Changed the Playground loader to reflect new database schema generated from the SQLite plugin. [#46825]
- Custom Colors: Ensure Customizer's custom colors are enqueued in the block editor when set. [#46863]
- Custom Colors: Fix block editor CSS not applying in Gutenberg 22.6.0+ iframe context. [#47603]
- Custom Colors: Prevent warnings when handling malformed data. [#45925]
- Ensure proper flags are used with `json_encode()`. [#46117]
- Fix "Really Simple SSL" typo in file path. [#46267]
- Fix disabling of outgoing pingbacks from staging sites. [#47752]
- Fix feature gating for payment blocks on WoW sites. [#46690]
- Fix plugin auto-update sync by preventing the `pre_option_auto_update_plugins` filter from interfering with Jetpack XML RPC requests. [#45636]
- Fix product features cache key to include gating-business-q1 sticker status for the calypso_plans_differentiators_20251210 experiment. [#46428]
- Fix the slug and file path for Really Simple Security (formerly Really Simple SSL) in the incompatibility list. [#46833]
- Footer: Avoid PHP errors when nested in output buffering. [#45732]
- I18n: Correct WPCOM locale fallback when theme .mo files use {textdomain}-{locale} names under the themes directory. [#48016]
- Jetpack: Remove getIconColor functions for block icons. [#45992]
- Legacy Pro plan: Remove artificial media storage limit. [#46543]
- Make Discussion Settings UI reflect that pingbacks are disabled on staging sites. [#47817]
- Managed Plugins: Handle malformed data gracefully. [#46053]
- Newsletter: Fix Reading page notice URL and link to new settings page when the jetpack_wp_admin_newsletter_settings_enabled filter is enabled. [#47347]
- Patch for A4A. [#46029]
- Phan: Address PhanPossiblyUndeclaredVariable violations. [#45911]
- Phan: Address PhanRedundantCondition, PhanRedundantArrayValuesCall, and PhanPluginRedundantAssignment violations. [#45681]
- Podcasting: Prevent PHP warnings when metadata is incomplete. [#46071]
- Prevent PHP 8.2+ deprecation warnings. [#45798]
- Prevent PHP errors when doing SSO bypass checks. [#45859]
- Prevent PHP errors when handling Google Fonts URLs. [#45858]
- Prevent PHP warnings when handling unexpected data types. [#45798]
- Private site: Auto-redirect to login. [#45584]
- Private sites: Prevent PHP errors. [#45860]
- Social: Fix the incorrect format of feature flag for unified UI v1. [#46078]
- Update wc-calypso-bridge. [#46731] [#47487] [#47816]
- Widgets: Prevent PHP warnings when variables are undefined or malformed. [#45934]
- Wrap deprecated no-op function in PHP version checks. [#45766]

## 8.0.0 - 2025-10-10
### Added
- Add Code block (experimental). [#45181]
- Add support for connection external storage class. [#44755]
- Improve compatibility for sites with `summer-special-2025` sticker. [#44680] [#45053] [#45199]
- Newspack blocks: Load feature on agency sites. [#44906]
- Staging Sites: Add CLI commands to clear WordPress.com Performance Profiler data after site cloning. [#45318]
- WPCOM Features: Add granular features for all theme tiers. [#45383]

### Changed
- CLI: Improve error searching in `diag` command. [#44902]
- Restrict unsupported file types from being selectable in media uploader based on site features. [#44798]
- Send JSON with built-in WordPress functions. [#45002]
- Update package dependencies. [#44725] [#44948] [#45096]
- WPCOM: Sync changes from class-wpcom-features.php [#45365]

### Removed
- Remove `WPCOMSH_Blog_Token_Resilience` class. [#45317] [#45384]

### Fixed
- Add missing WordPress.com feature checks on theme API functions on Atomic. [#45413]
- Code: Resolve PhanImpossibleCondition violations. [#44869]
- Freshly Pressed widget: Fix PHP warning. [#44962]
- MovableType Import: Prevent duplicated comments. [#45139]
- Update wc-calypso-bridge from 2.11.2 to 2.11.3. [#45409]

## 7.1.0 - 2025-08-05
### Added
- Add archives endpoint support. [#44028]
- Add a new `wp wpcomsh diagnostic` command. [#44363]
- Allow certain Personal and Premium plans to install plugins. [#44257] [#44414]
- Code editors: Added advanced code and CSS editors. [#44232]
- Forms: Include multistep form in Jetpack and WordPress.com plans. [#44309]
- SEO: Enable advanced features for localized version of developer.wordpress.com. [#43941]
- Settings: Add tracking for launch action. [#43859]

### Changed
- Improve performance of WordPress.com comment likes by caching and minimizing API requests. [#44205]
- My Jetpack: Unify the user connection flow with a unified screen. [#44469]
- Sync: Ignore the ActivityPub Outbox CPT. [#44222]
- Update package dependencies. [#44206] [#44217]

### Removed
- Remove backward compatibility for old version of `Error_Handler` class. [#44543]
- Remove CSS that hides connection info from the dashboard. [#43874]
- Remove language files after #42172, #42494, #42521, and #42550. [#44082]

### Fixed
- Allow default featured image in emails. [#44530]
- Bump wc-calypso-bridge package to 2.11.2. [#44111] [#44428]
- Fix connection tests. [#44281]
- JITM: Fix ineffective caching due to expired plugin sync transient. [#44117]
- JITM: Update to remove jQuery dependency. [#43783]
- Playground Importer: Fix query error generated by SQLite table with no entries in the data types cache table. [#43900]
- Private site: Ensure private sites return a valid cookie expiration value. [#44328]

## 7.0.0 - 2025-06-09
### Added
- Add ability to test with other Jetpack monorepo plugins active. [#43259]
- Add hook to signal a migration has ended using AIOWP. [#42992]
- Add support for protected connection owner. [#43601]
- Add jetpack-forms package dependency. [#43527]
- Featured Content: Add messaging to clarify that the tag name is case sensitive. [#43165]
- Forms: Add field-file feature/block support on WordPress.com plans. [#43177]
- Managed Plugin: Populate managed plugin list option on plugin install or update. [#43007]
- Social: Enable share status for all sites. [#43056]

### Changed
- Admin Menu: Update the icon of WooCommerce for the Woo installation. [#43029]
- bilmur: Include theme name. [#43452]
- Bump wc-calypso-bridge version. [#43038] [#43393]
- Compatibility: Use new `set_transient` hook in place of `setted_transient` hook deprecated in WordPress 6.8. [#43090]
- Consolidate widget-related code from wpcom and wpcomsh into jetpack-mu-wpcom. [#42974]
- Plugin management: Enable bulk plugin deactivation. [#42965]
- Site Visibility: Disable search engines indexing for sites with wpcomstaging.com domain. [#42853]
- Update package dependencies. [#43085] [#43425] [#43839]
- Use Jetpack Autoloader. [#43618]

### Deprecated
- Remove `default_rendering_mode` hotfix. [#42984]

### Removed
- Color Scheme: Clean up *-rgb css variables. [#42960]
- General: Update minimum WordPress version to 6.7. [#43192]
- Move "I voted" widget from wpcomsh to jetpack-mu-wpcom. [#42924]
- Remove legacy CI files. [#43434]
- Remove links to deprecated Calypso views on the launchpad tasks. [#42923]
- Remove wp-staging from incompatible plugins list. [#43170]
- Social: Remove unused feature flags. [#43037]

### Fixed
- Block editor: Fix layout issues with the Media Library modal buttons. [#43035]
- Check for classes and methods before call. [#43606]
- Code: Update stylesheets to use hex instead of named colors. [#42920]
- Code: Update stylesheets to use WordPress font styles. [#42928]
- Ensure Jetpack modules are enabled after transferring to WP Cloud. [#42971]
- Ensure wpcomsh users are able to purchase the Boost paid offering. [#43262]
- Fix wrapping on the stats column heading in non-English languages. [#43630]
- Fix Jetpack menu on untangled screens. [#43727]
- Linting: Clean up various Stylelint violations. [#43166]
- Linting: Do additional stylesheet cleanup. [#43247]
- Linting: Fix more Stylelint violations. [#43213]
- Linting: Remove outdated vendor prefixes in stylesheets. [#43219]
- Linting: Use double colon notation for pseudo-element selectors. [#43019]
- My Jetpack: Fix readability of license activation button on hover. [#43550]
- Podcasts: Make episode images comply with Apple requirements. [#43769]
- Tests: Add script that runs PHPUnit tests. [#43500]

## 6.1.0 - 2025-04-07
### Added
- Add `AI_SEO_ENHANCER` feature for Business plans and above and JP Complete plans. [#42731]
- Add Atomic site ID to WooCommerce tracker data. [#42588]
- Add a temporary version of Instant Search which excludes business/commerce sites for performance reasons. [#42117]
- Add newsletter widget. [#41807]
- Add Account Protection initialization. [#40925]
- Add site launch button to the admin bar. [#41240]
- Add subscribers in WP Admin boostrap page. [#42066]
- Add `wpcomsh_at_managed_plugins` option to allowed list for sync. [#42287]
- Bump a Tracks stat for every wp-admin page view. [#42422]
- Business sites are now added on Instant Search. [#41963]
- Connection: Disconnect all other users before disconnecting a connection owner account. [#41923]
- Dashboard: Add Daily Writing Prompt widget. [#41094]
- Dashboard: Add general tasks widget. [#41150]
- Dashboard: Add launchpad. [#41434]
- Dashboard: Add site preview and links. [#41106]
- External Media: Add external media modal on the Media Import page. [#41282]
- Hotfix: Add filter to hide the Elementor Beta/Dev install banner. [#42219]
- Import Media: Introduce the Import Media page. [#41032]
- Incompatible Plugins: Add `object-cache-pro` and variation of `wp-simple-firewall`. [#42654]
- Launchpad: Add `create-course-goal` intent task list. [#42108]
- Managed Plugins: Maintain list of Atomic-managed plugins. [#42164]
- Media Library: Support Upload from URL on media-new page. [#41627]
- Newsletter Dashboard Widget: Remove feature flag and enable widget. [#42276]
- Post List: Add a Copy Link Quick Action. [#41305]
- Social: Enable Social Post UI for WordPress.com. [#41219]
- Untangle Calypso media page. [#41628]
- WOA: Add WordAds post transfer action. [#38915]
- WPCOM Site Helper CLI: Add processing for `woocommerce_helper_data`. [#41910]

### Changed
- Add Complete to AI features and sync other changes on wpcom features. [#40545]
- Admin Bar: Point the Edit Site menu item to `site-editor.php`. [#41137]
- Admin Color Schemes: Update color schemes to match Calypso. [#40908]
- Report site timezone via Bilmur RUM library. [#41964]
- Code: First pass of style coding standards. [#42734]
- Code: Use function-style `exit()` and `die()` with a default status code of 0. [#41167]
- Connection: Allow pre-selected login providers. [#42662]
- Connection: Display connection status on Users page independent of the SSO module. [#41794]
- External Media: Move the GooglePhotosMedia, OpenverseMedia, and PexelsMedia to `@automattic/jetpack-shared-extension-utils`. [#41078]
- General: Indicate compatibility with WordPress 6.8. [#42701]
- Hide "Verify Email" launchpad task for existing users. [#41326]
- i18n: Use translations from WP_LANG_DIR. [#42521]
- Legacy Music Player Widget: Add hook to bump stats on view. [#42541]
- Legacy Music Player Widget: Hide from the block-based widget editor. [#42540]
- Media Library: Hide storage info on Atomic upload.php's uploader. [#41625]
- Move logo-tool to be within `jetpack-mu-wpcom`. [#42598]
- Prevent site owner from editing user's account-level fields. [#42177]
- Newspack Blocks: Updated to version 4.5.2. [#40636]
- Site Visibility: Port the site visibility settings from Calypso to WP Admin. [#42230]
- Social: Enable connections management for WordPress.com sites. [#41019]
- Social: Enable media sharing for WordPress.com Business plan. [#41355]
- Social: Enable social admin page for all WordPress.com sites. [#41713]
- Social: Enable Social Image Generator for WordPress.com sites. [#42548]
- Social: Use feature flag for social admin page. [#41413]
- SSO: Use same login page after logging out as when already logged out. [#42586]
- Theme: Clean up files that were used during the theme switch and theme preview. [#42420]
- Theme Switch: Do not change homepage when switching theme. [#42388]
- Typekit Custom Fonts: Add license. [#42862]
- Typekit Custom Fonts: Avoid deprecation notices in PHP 8.2. [#42862]
- Update AIOWP tracks events. [#40149]
- Update composer.lock file. [#41066]
- Update deployment section with automatic releases & deploys [#42608]
- Update package dependencies. [#40515] [#40814] [#40980] [#41659]
- Update minimum PHP version to 8.1. [#41928]
- Update package dependencies. [#42180] [#42815]
- Update Site Settings link copy. [#41663]
- Update wc-calypso-bridge dependency. [#41453] [#41569] [#42360] [#42531] [#42606] [#42720]
- Use a new endpoint to get the list of themes from WordPress.com [#42143]
- Use `automattic/jetpack-composer-plugin` so jetpack-library packages will be installed in a place where `wp i18n` will see them. [#41185]
- Enable WordAds module via WP-CLI post transfer. [#40909]

### Deprecated
- Remove an extra instant search feature which included the Business/commerce sites. [#42710]

### Removed
- Remove the "Personalize Link in Bio" launchpad task. [#41949]
- Remove the launch bar from the frontend of Atomic sites. [#41113]
- Start page pattern modal: Remove start page pattern modal and default to core behavior. [#41479]
- Default to core welcome guide instead of custom welcome tour when the user creates a post for the first time. [#41258]

### Fixed
- Add Business sites back to Classic Search.. [#42254]
- Admin Color Scheme: Fix the color of the Aquatic color scheme. [#42632]
- Avoid opening Fiverr link when hitting Enter. [#42093]
- Do not set default values for autoincrement columns. [#42257]
- Fix missing SQLite default driver index sizes. [#42371]
- Remove Customizer color styles from the editor. [#41186]
- Fix undefined array key warnings on any Customizer theme with colors. [#41136]
- Fix a database password escaping issue when installing tests. [#39258]
- Fix an issue where setting color identity on the Customizer breaks block editor UI elements. [#41073]
- Ensure the color palette now shows up. [#40846]
- Global Styles: Stop showing the limited global styles notice in distraction free mode. [#40907]
- Gutenberg 19.9: Hide launch banner when the site is previewed in Appearance -> Design. [#40695]
- i18n: Download updated translations for wpcomsh. [#42494]
- i18n: Load javascript translations from WP_LANG_DIR. [#42550]
- i18n: Load jetpack-mu-wpcom translations from WP_LANG_DIR/mu-plugins. [#42172]
- Media Library: Ensure Upload from URL shows in the editor. [#41711]
- Don't load ETK on agency sites on all pages. [#41272]
- Filter out the full-site-editing plugin from the active_plugins list if the plugin file doesn't exist. [#41887]
- Use blueberry (modern) scheme for launch site button. [#42605]
- Make email and password available on the profile.php on the default view. [#41945]
- Port the fix of the modern color scheme from WP 6.8. [#42462]
- Page & Post: Fix the layout on mobile when details are open. [#40872]
- Playground SQL Importer: Correctly handle `DB_HOST` containing a port. [#42439]
- Purge the cache when the site visibility changes on Atomic sites. [#40650]
- Site Badge: Update styles of the Coming Soon badge. [#42496]
- Site Visibility: Prevent accidental changes to blog_public on the Settings > Reading page. [#42716]
- Testimonials: Fix bug in shortcode if the column attribute is added and set to 0. [#40896]
- Verbum: Fix broken block editor. [#41747]
- wpcomsh/private-site: Use `allowed_options` filter instead of deprecated `whitelist_options` one and use proper function for adding the callback (`add_filter` instead of `add_action`). [#40586]

## 6.0.0 - 2024-12-04
### Added
- Add Growth to features in wpcomsh package. [#40187]
- Enable test coverage. [#39961]
- WordPress.com plan features: Added cornerstone 10 pages feature. [#40023]
- WordPress.com plan features: Added studio-sync feature. [#39843]

### Changed
- Added wp-downgrade to the incompatible list. [#39264]
- Admin dashboard: Disable portfolio toggle if theme supports portfolio and site is WoA. [#39508]
- General: indicate compatibility with the upcoming version of WordPress - 6.7. [#39786]
- Incompatible Plugins: whitelist duplicator pro. [#39775]
- Introduced ESLint base config and fixed errors. [#39275]
- Only include `wp-polyfill` as a script dependency when needed. [#39629]
- Remove unused dev dependencies. [#40297]
- Updated feature check. [#40120]
- Updated package dependencies. [#39594] [#39653] [#40116] [#40261]
- Update Jetpack Scan link. [#39619]
- Update wc-calypso-bridge dependency to 2.7.1 [#39557]
- Update wc-calypso-bridge dependency to 2.8.0 [#39613]
- Update wc-calypso-bridge dependency to 2.8.1 [#39950]

### Removed
- General: Update minimum WordPress version to 6.6. [#40146]
- Test remove redirection. [#39615]

### Fixed
- Fix function that add links to URLs in the page when having HTML attributes with "<" in the value. [#39931]
- Move `load_muplugin_textdomain` call to `after_setup_theme` hook. [#39586]
- Stats: Fix top post card on the Insight page. [#39691]
- wpcom-block-editor: Support getting the canvas mode from the query string after GB 19.6. [#40045]

## 5.10.0 - 2024-09-23
### Added
- Performance Profiler: Ensure the associated url created when the performance report is generated is accessible for each page or as part of site settings for the home/main url. [#39310]

### Removed
- Connection: Removed deprecated method features_available. [#39442] [#39475]

### Fixed
- Portfolios: Ensure these are enabled and working properly on themes that support portfolios. [#39431]

## 5.9.0 - 2024-09-18
### Changed
- WPCOMSH: change call to so it doesn't trigger if not necessary [#39336]

### Removed
- Wpcomsh: Remove actions and filters related to the Masterbar module [#39367]

### Fixed
- Color Scheme: Avoid wpcom user data overriding the admin color after flushing cache [#39368]
- WPCOM Features: Add INSTALL_THEMES feature to Jetpack sites so that they are not erroneously seeing the "upgrade" badge when looking at dotorg themes in the wordpress.com showcase [#39392]

## 5.8.0 - 2024-09-10
### Changed
- Enable Users -> Profile (profile.php) on all sites [#39181]
- SSO: Show wp-admin login form if site has local users [#39139]
- Updated package dependencies. [#39288]
- Update wc-calypso-bridge dependency to 2.6.0 [#39313]

### Fixed
- Checks an array key before attempting to read it. [#39240]

## 5.7.0 - 2024-09-02
### Added
- WPCOM Marketplace: Added software manager to install marketplace products. [#38705]

## 5.6.2 - 2024-08-30
### Added
- Added a switch that will enable rolling trunk releases. [#38994]

## 5.6.1 - 2024-08-26
### Changed
- Internal updates.

## 5.6.0 - 2024-08-23
### Added
- Added social share status feature [#39023]

### Changed
- SSO: Automatic logic for Calypso users of classic sites [#38996]
- Updated package dependencies. [#39004]

## 5.5.0 - 2024-08-21
### Changed
- Site Level User Profile: expose all relevant fields on profile.php [#38949]

### Fixed
- Revert recent SVG image optimizations. [#38981]

## 5.4.1 - 2024-08-19
### Added
- Incompatible Plugins: Added one-click-ssl [#38918]

### Changed
- Updated package dependencies. [#38822]

### Fixed
- Lossless image optimization for images (should improve performance with no visible changes). [#38750]

## 5.4.0 - 2024-08-13
### Changed
- rum data: include WooCommerce active status [#38846]

## 5.3.3 - 2024-08-12
### Changed
- Internal updates.

## 5.3.2 - 2024-08-12
### Changed
- Internal updates.

## 5.3.1 - 2024-08-09
### Added
- Added safeguards against erroneous WordPress hook invocations. [#37859]

## 5.3.0 - 2024-08-08
### Changed
- Plan name change: Add translations [#38726]
- Update translation files [#38736]

### Fixed
- Update wpcomsh POT file [#38728]

## 5.2.1 - 2024-08-05
### Changed
- Internal updates.

## 5.2.0 - 2024-08-05
### Changed
- Add target_blog_id prop to AIOWP tracks events [#38615]
- My Jetpack: modify Jetpack AI product class and interstitial links [#38602]
- Plan names: Revert plan names to Personal/Premium/Business/Commerce [#38668]

## 5.1.2 - 2024-07-30
### Changed
- Fixup versions [#38612]

## 5.1.1 - 2024-07-30
### Removed
- Remove the old plugin banner code [#38605]

## 5.1.0 - 2024-07-29
### Changed
- Hide the plugin banner on non-wpcom-connected users or agency-managed users [#38532]

## 5.0.3 - 2024-07-26
### Removed
- Footer credit: Remove customizer option for block themes [#38559]

## 5.0.2 - 2024-07-26
### Fixed
- Fix the "The parent theme is missing" issue [#38557]

## 5.0.1 - 2024-07-25
### Changed
- WooCommerce Calypso Bridge version update to 2.5.5 [#38469]

## 5.0.0 - 2024-07-23
### Added
- Added new feature for social editor preview. [#38425]
- Added checks to remove WP.com items and links in WP Admin for users who are not connected to WP.com. [#38401]
- i18n: Updated language files. [#38447]

### Changed
- Improve plugin-dance command. [#38423]
- Updated package dependencies. [#38464]
- Updated WooCommerce Calypso Brdige version to 2.5.4. [#38451]

### Removed
- Footer credit: Removed customizer option for block themes. [#38473]
- Footer credit: Render default credit on block themes. [#38458]
- Removed checks for Jetpack versions over a year old. [#38386]
- Removed code for compatibility with WordPress before 6.5. [#38386]

## 4.0.0 - 2024-07-18
### Removed
- General: update WordPress version requirements to WordPress 6.5. [#38382]
- Removed code that disables Jetpack staging mode for WordPress.com staging sites. [#38355]

### Fixed
- Removed access to WPCom Themes to WP_CLI [#38351]

## 3.28.0 - 2024-07-15
### Added
- Added a check to hide the plugins banner for non-wpcom connected users. [#38241]
- WOA Post Transfer: Ensure that HPOS is enabled for WooCommerce sites. [#38119]

### Changed
- WooCommerce Calypso Bridge: Update version to 2.5.3 [#38302]

## 3.27.3 - 2024-07-08
### Added
- Add post transfer woo express deactivate plugins, post process cache flush, and post clone set staging environment [#38183]

### Changed
- Updated package dependencies. [#38228]
- Use wp-cli `success` function for messages [#38201]

### Fixed
- Fix generate POT script to follow symlinks in vendor/* and update language files. [#38153]

## 3.27.2 - 2024-07-01
### Changed
- Internal updates.

## 3.27.1 - 2024-06-28
### Fixed
- Wpcomsh: fixed fatal errors in case of null body class values. [#38114]

## 3.27.0 - 2024-06-28
### Added
- Added plugin dance command [#38108]

## 3.26.1 - 2024-06-26
### Added
- Site Migrations: Add tracks events for AIOWPM events. [#37902]

### Changed
- Updated custom-fonts to v3.0.4. [#38071]

## 3.26.0 - 2024-06-26
### Added
- Added polyfill for get_magic_quotes_gpc [#38039]

## 3.25.2 - 2024-06-26
### Changed
- Internal updates.

## 3.25.1 - 2024-06-25
### Changed
- Hide login banner for agency-managed sites. [#38021]

### Removed
- Plugin hotfixes: Remove a hotfix for an issue fixed in Gutenberg 15.3.0. [#38015]

### Fixed
- Custom Colors: Remove a use of `extract()`. [#38015]
- Switch from Jetpack-the-plugin's `Jetpack_WPCOM_Block_Editor` class to jetpack-mu-wpcom's namespaced version. [#38015]

## 3.25.0 - 2024-06-25
### Added
- Added a command to disable fatal error emails. [#38010]
- Add `atomic_managed_plugin_row_auto_update_label` filter to translate the managed plugin auto update label [#37983]

## 3.24.0 - 2024-06-24
### Added
- Added featrue flag checks for the Threads Social Connection. [#38001]
- wpcomsh: Add WP-CLI commands with hooks for WoA post-transfer/reset/clone functionality [#37972]

## 3.23.0 - 2024-06-21
### Added
- New wpcomsh CLI command to fix PHP 7.4 plugin [#37966]
- Wpcomsh: Update plugin dependencies [#37812]

### Changed
- Bump lock files. [#37870]
- Site Visibility: Update link copy [#37909]

## 3.22.16 - 2024-06-17
### Changed
- Fixed readme, added accurate links. [#37901]

## 3.22.15 - 2024-06-17
### Added
- Added a prefix for wpcomsh weekly shipping. [#37857]

### Changed
- WooCommerce Calypso Brdige version update to 2.5.2 [#37883]

### Removed
- Disable WP.com custom editor navigation bar. [#37893]
- Removed obsolete scripts and makefile targets. [#37880]

## 3.22.14 - 2024-06-14
### Changed
- Changed the composer package slug to wpcomsh. [#37861]

### Removed
- General: removing action status icons. [#37881]

## 3.22.13 - 2024-06-13
### Removed
- Untangling: Remove temporary code that hides Hosting menu options. [#37848]

## 3.22.12 - 2024-06-10
### Other Changes
- Update language files.

## 3.22.11 - 2024-06-13
### Other Changes
- Bump wpcomsh version.

## 3.22.10 - 2024-06-07
### Changed
- Update read access cookie arguments.

## 3.22.9 - 2024-06-06
### Fixed
- Do not override text color if it is not set on the theme.

### Other Changes
- Update jetpack-mu-wpcom version.
- Bump wpcomsh version.

## 3.22.8 - 2024-06-06

- Prevent non array/object from working.

## 3.22.7 - 2024-06-05
### Added
- Add create_function polyfill.

## 3.22.6 - 2024-06-04
### Added
- Initial version. [#37737]

### Changed
- Nav Redesign: Drop the early access and is_proxied. [#37845]
- Updated package dependencies. [#37737]

### Removed
- Remove code to replace "Site visibility" with a link to Calypso [#37843]
- Revert adding overview menu option [#37844]

## 3.22.5 - 2024-05-31
### Other Changes
- Phan: fixed bugs and problems that triggered static analysis warnings.

[13.3]: https://wp.me/p1moTy-19qu

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).
