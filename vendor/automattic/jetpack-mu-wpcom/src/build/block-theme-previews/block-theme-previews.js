(()=>{"use strict";var e={52754:(e,t,o)=>{o.d(t,{A:()=>m});var r=o(56427),s=o(47143),i=o(27723),a=o(51609),c=o.n(a),l=o(95114);const __=i.__;function m(){const e=(0,l.T)(),t=(0,s.useSelect)((t=>t("core").getTheme(e)),[e]),o=(0,s.useSelect)((e=>!!e("core/edit-site")),[]),a=(0,s.useSelect)((e=>e("automattic/wpcom-block-theme-previews").isModalVisible()),[]),{dismissModal:m}=(0,s.useDispatch)("automattic/wpcom-block-theme-previews");return o&&a?c().createElement(r.Modal,{className:"wpcom-block-theme-previews-modal",onRequestClose:m,shouldCloseOnClickOutside:!1},c().createElement("div",{className:"wpcom-block-theme-previews-modal__content"},c().createElement("div",{className:"wpcom-block-theme-previews-modal__text"},c().createElement("h1",{className:"wpcom-block-theme-previews-modal__heading"},(0,i.sprintf)(
// translators: %s: theme name
__("You’re previewing %s","jetpack-mu-wpcom"),t?.name?.rendered||e)),c().createElement("div",{className:"wpcom-block-theme-previews-modal__description"},c().createElement("p",null,__("Changes you make in the editor won’t be applied to your site until you activate the theme.","jetpack-mu-wpcom")),c().createElement("p",null,__("Try customizing your theme styles to get your site looking just right.","jetpack-mu-wpcom"))),c().createElement("div",{className:"wpcom-block-theme-previews-modal__actions"},c().createElement(r.Button,{variant:"primary",onClick:m},__("Start customizing","jetpack-mu-wpcom")))),c().createElement("div",{className:"wpcom-block-theme-previews-modal__video"},c().createElement("video",{autoPlay:!0,loop:!0,muted:!0},c().createElement("source",{src:"https://videos.files.wordpress.com/gTXUlIAB/wpcom-block-theme-previews-modal.mp4",type:"video/mp4"}))))):null}},64294:(e,t,o)=>{var r=o(47143);const s={isModalVisible:!0};(0,r.registerStore)("automattic/wpcom-block-theme-previews",{reducer:(e=s,t)=>"DISMISS_MODAL"===t.type?{...e,isModalVisible:!1}:e,actions:{dismissModal:()=>({type:"DISMISS_MODAL"})},selectors:{isModalVisible:e=>e.isModalVisible},persist:!0})},95114:(e,t,o)=>{o.d(t,{T:()=>s});var r=o(93832);function s(){return(0,r.getQueryArg)(window.location.href,"wp_theme_preview")}},51609:e=>{e.exports=window.React},56427:e=>{e.exports=window.wp.components},47143:e=>{e.exports=window.wp.data},98490:e=>{e.exports=window.wp.domReady},27723:e=>{e.exports=window.wp.i18n},92279:e=>{e.exports=window.wp.plugins},93832:e=>{e.exports=window.wp.url}},t={};function o(r){var s=t[r];if(void 0!==s)return s.exports;var i=t[r]={exports:{}};return e[r](i,i.exports,o),i.exports}o.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return o.d(t,{a:t}),t},o.d=(e,t)=>{for(var r in t)o.o(t,r)&&!o.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t);var r=o(98490),s=o.n(r),i=o(92279),a=o(52754);o(64294);s()((()=>{(0,i.registerPlugin)("wpcom-block-theme-previews",{render:a.A})}))})();