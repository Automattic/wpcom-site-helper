(()=>{"use strict";var t={92299:(t,e,n)=>{n.d(e,{k:()=>i});const i=(t,e={},n=null,i=null)=>{const s=JP_CONNECTION_INITIAL_STATE?.userConnectionData?.currentUser??{},o=n??s.id,a=i??s.username,r=e.blogId??s.blogId;window._tkq=window._tkq||[],a&&o&&window._tkq.push(["identifyUser",o,a]),window._tkq.push(["recordEvent",t,{...e,blog_id:r}])}}},e={};function n(i){var s=e[i];if(void 0!==s)return s.exports;var o=e[i]={exports:{}};return t[i](o,o.exports,n),o.exports}n.d=(t,e)=>{for(var i in e)n.o(e,i)&&!n.o(t,i)&&Object.defineProperty(t,i,{enumerable:!0,get:e[i]})},n.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e);var i=n(92299);const s=t=>{t&&(0,i.k)(t.name,t.props,wpcomSidebarNotice.user.ID,wpcomSidebarNotice.user.username)};document.addEventListener("DOMContentLoaded",(()=>{const t=document.querySelector("#adminmenu");if(!t||"undefined"==typeof wpcomSidebarNotice)return;t.insertAdjacentHTML("afterbegin",`\n\t\t\t<li\n\t\t\t\tid="toplevel_page_site-notices"\n\t\t\t\tclass="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_site-notices"\n\t\t\t\tdata-id="${wpcomSidebarNotice.id}"\n\t\t\t\tdata-feature-class="${wpcomSidebarNotice.featureClass}"\n\t\t\t>\n\t\t\t\t<a href="${wpcomSidebarNotice.url}" class="wp-not-current-submenu menu-top menu-icon-generic toplevel_page_site-notices">\n\t\t\t\t\t<div class="wp-menu-name">\n\t\t\t\t\t\t<div class="upsell_banner">\n\t\t\t\t\t\t\t<div class="upsell_banner__icon dashicons" aria-hidden="true"></div>\n\t\t\t\t\t\t\t<div class="upsell_banner__text">${wpcomSidebarNotice.text}</div>\n\t\t\t\t\t\t\t<button type="button" class="upsell_banner__action button">${wpcomSidebarNotice.action}</button>\n\t\t\t\t\t\t\t${wpcomSidebarNotice.dismissible?'<button type="button" class="upsell_banner__dismiss button button-link">'+wpcomSidebarNotice.dismissLabel+"</button>":""}\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</a>\n\t\t\t</li>\n\t\t`),s(wpcomSidebarNotice.tracks?.display);const e=t.firstElementChild;e.addEventListener("click",(t=>{t.target.classList.contains("upsell_banner__dismiss")||t.target.closest(".upsell_banner__dismiss")?(t.preventDefault(),wp.ajax.post("wpcom_dismiss_sidebar_notice",{id:e.dataset.id,feature_class:e.dataset.featureClass,_ajax_nonce:wpcomSidebarNotice.dismissNonce}),e.remove(),s(wpcomSidebarNotice.tracks?.dismiss)):s(wpcomSidebarNotice.tracks?.click)}))}))})();