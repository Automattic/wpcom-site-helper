/**
 * Disable the email field on Simple sites.
 */
const wpcom_profile_settings_disable_email_field = () => {
	if ( ! window.wpcomProfileSettingsLinkToWpcom?.isWpcomSimple ) {
		return;
	}
	const emailField = document.getElementById( 'email' ) as HTMLInputElement;
	if ( emailField ) {
		emailField.disabled = true;
	}

	const emailDescription = document.getElementById( 'email-description' ) as HTMLInputElement;
	emailDescription?.remove();
};

/**
 * Add a link to the WordPress.com profile settings page.
 */
const wpcom_profile_settings_add_links_to_wpcom = () => {
	const emailSection = document.querySelector( '.user-email-wrap' )?.querySelector( 'td' );
	const newPasswordSection = document.getElementById( 'password' )?.querySelector( 'td' );
	const userSessionSection = document.querySelector( '.user-sessions-wrap' );

	userSessionSection?.remove();

	// Simple sites cannot set a password in wp-admin.
	if ( window.wpcomProfileSettingsLinkToWpcom?.isWpcomSimple && newPasswordSection ) {
		newPasswordSection.innerHTML = '';
	}

	const emailSettingsLink = window.wpcomProfileSettingsLinkToWpcom?.email?.link;
	const emailSettingsLinkText = window.wpcomProfileSettingsLinkToWpcom?.email?.text;
	if ( emailSection && emailSettingsLink && emailSettingsLinkText ) {
		const notice = document.createElement( 'p' );
		notice.className = 'description';
		notice.innerHTML = `<a href="${ emailSettingsLink }">${ emailSettingsLinkText }</a>.`;
		emailSection.appendChild( notice );
	}

	const passwordSettingsLink = window.wpcomProfileSettingsLinkToWpcom?.password?.link;
	const passwordSettingsLinkText = window.wpcomProfileSettingsLinkToWpcom?.password?.text;
	if ( newPasswordSection && passwordSettingsLink && passwordSettingsLinkText ) {
		const notice = document.createElement( 'p' );
		notice.className = 'description';
		notice.innerHTML = `<a href="${ passwordSettingsLink }">${ passwordSettingsLinkText }</a>.`;
		newPasswordSection.appendChild( notice );
	}
};

document.addEventListener( 'DOMContentLoaded', () => {
	wpcom_profile_settings_add_links_to_wpcom();
	wpcom_profile_settings_disable_email_field();
} );
