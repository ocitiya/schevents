(()=>{"use strict";var e={6618:(e,t,r)=>{r(8964),r(702);var o=r(1957),n=r(8266),a=r(499),i=r(9835);function s(e,t,r,o,n,a){const s=(0,i.up)("router-view");return(0,i.wg)(),(0,i.j4)(s)}const l=(0,i.aZ)({name:"App"});var c=r(1639);const u=(0,c.Z)(l,[["render",s]]),d=u;var p=r(3340),f=r(2502);const h=(0,p.h)((()=>{const e=(0,f.WB)();return e}));var m=r(8339);const b=[{path:"/",component:()=>Promise.all([r.e(736),r.e(564)]).then(r.bind(r,4564)),children:[{path:"",name:"home",component:()=>Promise.all([r.e(736),r.e(536)]).then(r.bind(r,7670))},{path:"club",name:"club",component:()=>Promise.all([r.e(736),r.e(932)]).then(r.bind(r,6932))},{path:"about",name:"about",component:()=>Promise.all([r.e(736),r.e(751)]).then(r.bind(r,5751))},{path:"scores",name:"scores",component:()=>Promise.all([r.e(736),r.e(425)]).then(r.bind(r,1524))},{path:"news",name:"news",component:()=>Promise.all([r.e(736),r.e(480)]).then(r.bind(r,9480))},{path:"news/:id",name:"news.detail",component:()=>Promise.all([r.e(736),r.e(381)]).then(r.bind(r,695))},{path:"video",name:"video",component:()=>Promise.all([r.e(736),r.e(189)]).then(r.bind(r,2950))}]},{path:"/:catchAll(.*)*",component:()=>Promise.all([r.e(736),r.e(862)]).then(r.bind(r,1862))}],v=b,g=(0,p.BC)((function(){const e=m.r5,t=(0,m.p7)({scrollBehavior:()=>({left:0,top:0}),routes:v,history:e("")});return t}));async function y(e,t){const r=e(d);r.use(n.Z,t);const o="function"===typeof h?await h({}):h;r.use(o);const i=(0,a.Xl)("function"===typeof g?await g({store:o}):g);return o.use((({store:e})=>{e.router=i})),{app:r,store:o,router:i}}const w={config:{}},P="";async function O({app:e,router:t,store:r},o){let n=!1;const a=e=>{try{return t.resolve(e).href}catch(r){}return Object(e)===e?null:e},i=e=>{if(n=!0,"string"===typeof e&&/^https?:\/\//.test(e))return void(window.location.href=e);const t=a(e);null!==t&&(window.location.href=t,window.location.reload())},s=window.location.href.replace(window.location.origin,"");for(let c=0;!1===n&&c<o.length;c++)try{await o[c]({app:e,router:t,store:r,ssrContext:null,redirect:i,urlPath:s,publicPath:P})}catch(l){return l&&l.url?void i(l.url):void console.error("[Quasar] boot error:",l)}!0!==n&&(e.use(t),e.mount("#q-app"))}y(o.ri,w).then((e=>Promise.all([Promise.resolve().then(r.bind(r,6288)),Promise.resolve().then(r.bind(r,1569))]).then((t=>{const r=t.map((e=>e.default)).filter((e=>"function"===typeof e));O(e,r)}))))},1569:(e,t,r)=>{r.r(t),r.d(t,{api:()=>s,default:()=>l});var o=r(3340),n=r(9981),a=r.n(n);const i="https://schsports.com",s=a().create({baseURL:`${i}/api`}),l=(0,o.xr)((({app:e})=>{e.config.globalProperties.$host=i,e.config.globalProperties.$axios=a(),e.config.globalProperties.$api=s}))},6288:(e,t,r)=>{r.r(t),r.d(t,{default:()=>s});var o=r(3340),n=r(9991);const a={failed:"Action failed",success:"Action was successful"},i={"en-US":a},s=(0,o.xr)((({app:e})=>{const t=(0,n.o)({locale:"en-US",messages:i});e.use(t)}))}},t={};function r(o){var n=t[o];if(void 0!==n)return n.exports;var a=t[o]={id:o,loaded:!1,exports:{}};return e[o].call(a.exports,a,a.exports,r),a.loaded=!0,a.exports}r.m=e,(()=>{var e=[];r.O=(t,o,n,a)=>{if(!o){var i=1/0;for(u=0;u<e.length;u++){for(var[o,n,a]=e[u],s=!0,l=0;l<o.length;l++)(!1&a||i>=a)&&Object.keys(r.O).every((e=>r.O[e](o[l])))?o.splice(l--,1):(s=!1,a<i&&(i=a));if(s){e.splice(u--,1);var c=n();void 0!==c&&(t=c)}}return t}a=a||0;for(var u=e.length;u>0&&e[u-1][2]>a;u--)e[u]=e[u-1];e[u]=[o,n,a]}})(),(()=>{r.n=e=>{var t=e&&e.__esModule?()=>e["default"]:()=>e;return r.d(t,{a:t}),t}})(),(()=>{r.d=(e,t)=>{for(var o in t)r.o(t,o)&&!r.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})}})(),(()=>{r.f={},r.e=e=>Promise.all(Object.keys(r.f).reduce(((t,o)=>(r.f[o](e,t),t)),[]))})(),(()=>{r.u=e=>"js/"+e+"."+{189:"5ea66545",381:"6e4c7a06",425:"6673efed",480:"87103f7f",536:"4f8f8e8b",564:"66946bf0",751:"d3ea9583",862:"f7100986",932:"ee6c5ee6"}[e]+".js"})(),(()=>{r.miniCssF=e=>"css/"+({143:"app",736:"vendor"}[e]||e)+"."+{143:"2dcdbbd4",189:"2cb841db",381:"50353e43",425:"ef16388c",480:"bbffd22e",536:"aabb1256",736:"94ea8f4f",751:"7d821771",932:"2616d04a"}[e]+".css"})(),(()=>{r.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"===typeof window)return window}}()})(),(()=>{r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)})(),(()=>{var e={},t="home-app:";r.l=(o,n,a,i)=>{if(e[o])e[o].push(n);else{var s,l;if(void 0!==a)for(var c=document.getElementsByTagName("script"),u=0;u<c.length;u++){var d=c[u];if(d.getAttribute("src")==o||d.getAttribute("data-webpack")==t+a){s=d;break}}s||(l=!0,s=document.createElement("script"),s.charset="utf-8",s.timeout=120,r.nc&&s.setAttribute("nonce",r.nc),s.setAttribute("data-webpack",t+a),s.src=o),e[o]=[n];var p=(t,r)=>{s.onerror=s.onload=null,clearTimeout(f);var n=e[o];if(delete e[o],s.parentNode&&s.parentNode.removeChild(s),n&&n.forEach((e=>e(r))),t)return t(r)},f=setTimeout(p.bind(null,void 0,{type:"timeout",target:s}),12e4);s.onerror=p.bind(null,s.onerror),s.onload=p.bind(null,s.onload),l&&document.head.appendChild(s)}}})(),(()=>{r.r=e=>{"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}})(),(()=>{r.nmd=e=>(e.paths=[],e.children||(e.children=[]),e)})(),(()=>{r.p=""})(),(()=>{var e=(e,t,r,o)=>{var n=document.createElement("link");n.rel="stylesheet",n.type="text/css";var a=a=>{if(n.onerror=n.onload=null,"load"===a.type)r();else{var i=a&&("load"===a.type?"missing":a.type),s=a&&a.target&&a.target.href||t,l=new Error("Loading CSS chunk "+e+" failed.\n("+s+")");l.code="CSS_CHUNK_LOAD_FAILED",l.type=i,l.request=s,n.parentNode.removeChild(n),o(l)}};return n.onerror=n.onload=a,n.href=t,document.head.appendChild(n),n},t=(e,t)=>{for(var r=document.getElementsByTagName("link"),o=0;o<r.length;o++){var n=r[o],a=n.getAttribute("data-href")||n.getAttribute("href");if("stylesheet"===n.rel&&(a===e||a===t))return n}var i=document.getElementsByTagName("style");for(o=0;o<i.length;o++){n=i[o],a=n.getAttribute("data-href");if(a===e||a===t)return n}},o=o=>new Promise(((n,a)=>{var i=r.miniCssF(o),s=r.p+i;if(t(i,s))return n();e(o,s,n,a)})),n={143:0};r.f.miniCss=(e,t)=>{var r={189:1,381:1,425:1,480:1,536:1,751:1,932:1};n[e]?t.push(n[e]):0!==n[e]&&r[e]&&t.push(n[e]=o(e).then((()=>{n[e]=0}),(t=>{throw delete n[e],t})))}})(),(()=>{var e={143:0};r.f.j=(t,o)=>{var n=r.o(e,t)?e[t]:void 0;if(0!==n)if(n)o.push(n[2]);else{var a=new Promise(((r,o)=>n=e[t]=[r,o]));o.push(n[2]=a);var i=r.p+r.u(t),s=new Error,l=o=>{if(r.o(e,t)&&(n=e[t],0!==n&&(e[t]=void 0),n)){var a=o&&("load"===o.type?"missing":o.type),i=o&&o.target&&o.target.src;s.message="Loading chunk "+t+" failed.\n("+a+": "+i+")",s.name="ChunkLoadError",s.type=a,s.request=i,n[1](s)}};r.l(i,l,"chunk-"+t,t)}},r.O.j=t=>0===e[t];var t=(t,o)=>{var n,a,[i,s,l]=o,c=0;if(i.some((t=>0!==e[t]))){for(n in s)r.o(s,n)&&(r.m[n]=s[n]);if(l)var u=l(r)}for(t&&t(o);c<i.length;c++)a=i[c],r.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return r.O(u)},o=globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var o=r.O(void 0,[736],(()=>r(6618)));o=r.O(o)})();