document.addEventListener("DOMContentLoaded",(()=>{(()=>{const e=document.querySelector(".user-email-wrap")?.querySelector("td"),o=document.getElementById("password")?.querySelector("td"),n=document.querySelector(".user-sessions-wrap");n?.remove(),window.wpcomProfileSettingsLinkToWpcom?.isWpcomSimple&&o&&(o.innerHTML="");const t=window.wpcomProfileSettingsLinkToWpcom?.email?.link,i=window.wpcomProfileSettingsLinkToWpcom?.email?.text;if(e&&t&&i){const o=document.createElement("p");o.className="description",o.innerHTML=`<a href="${t}">${i}</a>.`,e.appendChild(o)}const c=window.wpcomProfileSettingsLinkToWpcom?.password?.link,m=window.wpcomProfileSettingsLinkToWpcom?.password?.text;if(o&&c&&m){const e=document.createElement("p");e.className="description",e.innerHTML=`<a href="${c}">${m}</a>.`,o.appendChild(e)}})(),(()=>{if(!window.wpcomProfileSettingsLinkToWpcom?.isWpcomSimple)return;const e=document.getElementById("email");e&&(e.readOnly=!0);const o=document.getElementById("email-description");o?.remove()})()}));