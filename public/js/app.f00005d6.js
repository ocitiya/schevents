(()=>{var e={6618:(e,t,s)=>{"use strict";s(8964),s(702);var n=s(1957),r=s(8266),o=s(499),a=s(9835);function i(e,t,s,n,r,o){const i=(0,a.up)("router-view");return(0,a.wg)(),(0,a.j4)(i)}const l=(0,a.aZ)({name:"App"});var c=s(1639);const u=(0,c.Z)(l,[["render",i]]),d=u;var j=s(3340),h=s(2502);const m=(0,j.h)((()=>{const e=(0,h.WB)();return e}));var p=s(8339);const f=[{path:"/",component:()=>Promise.all([s.e(736),s.e(184)]).then(s.bind(s,8184)),children:[{path:"",name:"home",component:()=>Promise.all([s.e(736),s.e(57)]).then(s.bind(s,7057))},{path:"schedule",name:"schedule",component:()=>Promise.all([s.e(736),s.e(575)]).then(s.bind(s,575))},{path:"club",name:"club",component:()=>Promise.all([s.e(736),s.e(532)]).then(s.bind(s,4291))},{path:"about",name:"about",component:()=>Promise.all([s.e(736),s.e(419)]).then(s.bind(s,9419))},{path:"scores",name:"scores",component:()=>Promise.all([s.e(736),s.e(441)]).then(s.bind(s,7441))},{path:"news",name:"news",component:()=>Promise.all([s.e(736),s.e(701)]).then(s.bind(s,9701))},{path:"news/:id",name:"news.detail",component:()=>Promise.all([s.e(736),s.e(379)]).then(s.bind(s,3379))},{path:"video",name:"video",component:()=>Promise.all([s.e(736),s.e(558)]).then(s.bind(s,558))},{path:"event",name:"event",component:()=>Promise.all([s.e(736),s.e(313)]).then(s.bind(s,5313))},{path:"movie",name:"movie",component:()=>Promise.all([s.e(736),s.e(684)]).then(s.bind(s,3684))}]},{path:"/:catchAll(.*)*",component:()=>Promise.all([s.e(736),s.e(862)]).then(s.bind(s,1862))}],b=f,v=(0,j.BC)((function(){const e=p.PO,t=(0,p.p7)({scrollBehavior:()=>({left:0,top:0}),routes:b,history:e("/")});return t}));async function g(e,t){const s=e(d);s.use(r.Z,t);const n="function"===typeof m?await m({}):m;s.use(n);const a=(0,o.Xl)("function"===typeof v?await v({store:n}):v);return n.use((({store:e})=>{e.router=a})),{app:s,store:n,router:a}}var y=s(6950),k=s(6229);const w={config:{},plugins:{Loading:y.Z,Meta:k.ZP}},P="/";async function z({app:e,router:t,store:s},n){let r=!1;const o=e=>{try{return t.resolve(e).href}catch(s){}return Object(e)===e?null:e},a=e=>{if(r=!0,"string"===typeof e&&/^https?:\/\//.test(e))return void(window.location.href=e);const t=o(e);null!==t&&(window.location.href=t)},i=window.location.href.replace(window.location.origin,"");for(let c=0;!1===r&&c<n.length;c++)try{await n[c]({app:e,router:t,store:s,ssrContext:null,redirect:a,urlPath:i,publicPath:P})}catch(l){return l&&l.url?void a(l.url):void console.error("[Quasar] boot error:",l)}!0!==r&&(e.use(t),e.mount("#q-app"))}g(n.ri,w).then((e=>Promise.all([Promise.resolve().then(s.bind(s,6288)),Promise.resolve().then(s.bind(s,1569))]).then((t=>{const s=t.map((e=>e.default)).filter((e=>"function"===typeof e));z(e,s)}))))},1569:(e,t,s)=>{"use strict";s.r(t),s.d(t,{api:()=>u,default:()=>d});var n=s(3340),r=s(9981),o=s.n(r),a=(s(9829),s(3878)),i=s.n(a);const l=i().tz.guess(),c="https://live.schsports.com",u=o().create({baseURL:`${c}/api`,headers:{Timezone:l}});u.interceptors.request.use((function(e){return e}),(function(e){return Promise.reject(e)}));const d=(0,n.xr)((({app:e})=>{e.config.globalProperties.$host=c,e.config.globalProperties.$axios=o(),e.config.globalProperties.$api=u}))},6288:(e,t,s)=>{"use strict";s.r(t),s.d(t,{default:()=>i});var n=s(3340),r=s(9991);const o={failed:"Action failed",success:"Action was successful"},a={"en-US":o},i=(0,n.xr)((({app:e})=>{const t=(0,r.o)({locale:"en-US",messages:a});e.use(t)}))},6700:(e,t,s)=>{var n={"./af":202,"./af.js":202,"./ar":6314,"./ar-dz":5666,"./ar-dz.js":5666,"./ar-kw":6591,"./ar-kw.js":6591,"./ar-ly":7900,"./ar-ly.js":7900,"./ar-ma":5667,"./ar-ma.js":5667,"./ar-sa":4092,"./ar-sa.js":4092,"./ar-tn":6916,"./ar-tn.js":6916,"./ar.js":6314,"./az":1699,"./az.js":1699,"./be":8988,"./be.js":8988,"./bg":7437,"./bg.js":7437,"./bm":7947,"./bm.js":7947,"./bn":2851,"./bn-bd":4905,"./bn-bd.js":4905,"./bn.js":2851,"./bo":7346,"./bo.js":7346,"./br":1711,"./br.js":1711,"./bs":3706,"./bs.js":3706,"./ca":112,"./ca.js":112,"./cs":6406,"./cs.js":6406,"./cv":1853,"./cv.js":1853,"./cy":9766,"./cy.js":9766,"./da":6836,"./da.js":6836,"./de":9320,"./de-at":4904,"./de-at.js":4904,"./de-ch":6710,"./de-ch.js":6710,"./de.js":9320,"./dv":3274,"./dv.js":3274,"./el":286,"./el.js":286,"./en-au":143,"./en-au.js":143,"./en-ca":237,"./en-ca.js":237,"./en-gb":2428,"./en-gb.js":2428,"./en-ie":3349,"./en-ie.js":3349,"./en-il":3764,"./en-il.js":3764,"./en-in":7809,"./en-in.js":7809,"./en-nz":9851,"./en-nz.js":9851,"./en-sg":5594,"./en-sg.js":5594,"./eo":4483,"./eo.js":4483,"./es":2184,"./es-do":5777,"./es-do.js":5777,"./es-mx":9356,"./es-mx.js":9356,"./es-us":8496,"./es-us.js":8496,"./es.js":2184,"./et":7578,"./et.js":7578,"./eu":2092,"./eu.js":2092,"./fa":5927,"./fa.js":5927,"./fi":171,"./fi.js":171,"./fil":2416,"./fil.js":2416,"./fo":9937,"./fo.js":9937,"./fr":5172,"./fr-ca":8249,"./fr-ca.js":8249,"./fr-ch":7541,"./fr-ch.js":7541,"./fr.js":5172,"./fy":7907,"./fy.js":7907,"./ga":6361,"./ga.js":6361,"./gd":2282,"./gd.js":2282,"./gl":2630,"./gl.js":2630,"./gom-deva":680,"./gom-deva.js":680,"./gom-latn":6220,"./gom-latn.js":6220,"./gu":6272,"./gu.js":6272,"./he":5540,"./he.js":5540,"./hi":6067,"./hi.js":6067,"./hr":9669,"./hr.js":9669,"./hu":3396,"./hu.js":3396,"./hy-am":6678,"./hy-am.js":6678,"./id":4812,"./id.js":4812,"./is":4193,"./is.js":4193,"./it":7863,"./it-ch":959,"./it-ch.js":959,"./it.js":7863,"./ja":1809,"./ja.js":1809,"./jv":8657,"./jv.js":8657,"./ka":3290,"./ka.js":3290,"./kk":8418,"./kk.js":8418,"./km":7687,"./km.js":7687,"./kn":1375,"./kn.js":1375,"./ko":2641,"./ko.js":2641,"./ku":3518,"./ku.js":3518,"./ky":5459,"./ky.js":5459,"./lb":1978,"./lb.js":1978,"./lo":6915,"./lo.js":6915,"./lt":8948,"./lt.js":8948,"./lv":2548,"./lv.js":2548,"./me":8608,"./me.js":8608,"./mi":333,"./mi.js":333,"./mk":6611,"./mk.js":6611,"./ml":999,"./ml.js":999,"./mn":4098,"./mn.js":4098,"./mr":6111,"./mr.js":6111,"./ms":3717,"./ms-my":265,"./ms-my.js":265,"./ms.js":3717,"./mt":8980,"./mt.js":8980,"./my":6895,"./my.js":6895,"./nb":5348,"./nb.js":5348,"./ne":1493,"./ne.js":1493,"./nl":4419,"./nl-be":5576,"./nl-be.js":5576,"./nl.js":4419,"./nn":6907,"./nn.js":6907,"./oc-lnc":2321,"./oc-lnc.js":2321,"./pa-in":9239,"./pa-in.js":9239,"./pl":7627,"./pl.js":7627,"./pt":5703,"./pt-br":1623,"./pt-br.js":1623,"./pt.js":5703,"./ro":2747,"./ro.js":2747,"./ru":4420,"./ru.js":4420,"./sd":2148,"./sd.js":2148,"./se":2461,"./se.js":2461,"./si":2783,"./si.js":2783,"./sk":3306,"./sk.js":3306,"./sl":341,"./sl.js":341,"./sq":2768,"./sq.js":2768,"./sr":2451,"./sr-cyrl":3371,"./sr-cyrl.js":3371,"./sr.js":2451,"./ss":8812,"./ss.js":8812,"./sv":3820,"./sv.js":3820,"./sw":3615,"./sw.js":3615,"./ta":2869,"./ta.js":2869,"./te":2044,"./te.js":2044,"./tet":5861,"./tet.js":5861,"./tg":6999,"./tg.js":6999,"./th":926,"./th.js":926,"./tk":7443,"./tk.js":7443,"./tl-ph":9786,"./tl-ph.js":9786,"./tlh":2812,"./tlh.js":2812,"./tr":6952,"./tr.js":6952,"./tzl":9573,"./tzl.js":9573,"./tzm":5990,"./tzm-latn":6961,"./tzm-latn.js":6961,"./tzm.js":5990,"./ug-cn":2610,"./ug-cn.js":2610,"./uk":9498,"./uk.js":9498,"./ur":3970,"./ur.js":3970,"./uz":9006,"./uz-latn":26,"./uz-latn.js":26,"./uz.js":9006,"./vi":9962,"./vi.js":9962,"./x-pseudo":8407,"./x-pseudo.js":8407,"./yo":1962,"./yo.js":1962,"./zh-cn":8909,"./zh-cn.js":8909,"./zh-hk":4014,"./zh-hk.js":4014,"./zh-mo":996,"./zh-mo.js":996,"./zh-tw":6327,"./zh-tw.js":6327};function r(e){var t=o(e);return s(t)}function o(e){if(!s.o(n,e)){var t=new Error("Cannot find module '"+e+"'");throw t.code="MODULE_NOT_FOUND",t}return n[e]}r.keys=function(){return Object.keys(n)},r.resolve=o,e.exports=r,r.id=6700}},t={};function s(n){var r=t[n];if(void 0!==r)return r.exports;var o=t[n]={id:n,loaded:!1,exports:{}};return e[n].call(o.exports,o,o.exports,s),o.loaded=!0,o.exports}s.m=e,(()=>{var e=[];s.O=(t,n,r,o)=>{if(!n){var a=1/0;for(u=0;u<e.length;u++){for(var[n,r,o]=e[u],i=!0,l=0;l<n.length;l++)(!1&o||a>=o)&&Object.keys(s.O).every((e=>s.O[e](n[l])))?n.splice(l--,1):(i=!1,o<a&&(a=o));if(i){e.splice(u--,1);var c=r();void 0!==c&&(t=c)}}return t}o=o||0;for(var u=e.length;u>0&&e[u-1][2]>o;u--)e[u]=e[u-1];e[u]=[n,r,o]}})(),(()=>{s.n=e=>{var t=e&&e.__esModule?()=>e["default"]:()=>e;return s.d(t,{a:t}),t}})(),(()=>{s.d=(e,t)=>{for(var n in t)s.o(t,n)&&!s.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})}})(),(()=>{s.f={},s.e=e=>Promise.all(Object.keys(s.f).reduce(((t,n)=>(s.f[n](e,t),t)),[]))})(),(()=>{s.u=e=>"js/"+e+"."+{57:"32998104",184:"34c30457",313:"ed82c4ee",379:"82027882",419:"89e46268",441:"0edd2f7a",532:"ae51a5ba",558:"c3dae333",575:"1868ab2d",684:"a3a6cf12",701:"b9866478",862:"37519118"}[e]+".js"})(),(()=>{s.miniCssF=e=>"css/"+({143:"app",736:"vendor"}[e]||e)+"."+{57:"59648778",143:"c589a4fc",184:"38c4cbae",313:"bfd6a41b",379:"3ac9b42d",419:"e4d819e9",441:"b2898fc9",532:"5bd5fcd9",558:"8d24de49",575:"66ee1918",684:"997c828b",701:"d403f21e",736:"a5b57815"}[e]+".css"})(),(()=>{s.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"===typeof window)return window}}()})(),(()=>{s.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t)})(),(()=>{var e={},t="home-app:";s.l=(n,r,o,a)=>{if(e[n])e[n].push(r);else{var i,l;if(void 0!==o)for(var c=document.getElementsByTagName("script"),u=0;u<c.length;u++){var d=c[u];if(d.getAttribute("src")==n||d.getAttribute("data-webpack")==t+o){i=d;break}}i||(l=!0,i=document.createElement("script"),i.charset="utf-8",i.timeout=120,s.nc&&i.setAttribute("nonce",s.nc),i.setAttribute("data-webpack",t+o),i.src=n),e[n]=[r];var j=(t,s)=>{i.onerror=i.onload=null,clearTimeout(h);var r=e[n];if(delete e[n],i.parentNode&&i.parentNode.removeChild(i),r&&r.forEach((e=>e(s))),t)return t(s)},h=setTimeout(j.bind(null,void 0,{type:"timeout",target:i}),12e4);i.onerror=j.bind(null,i.onerror),i.onload=j.bind(null,i.onload),l&&document.head.appendChild(i)}}})(),(()=>{s.r=e=>{"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}})(),(()=>{s.nmd=e=>(e.paths=[],e.children||(e.children=[]),e)})(),(()=>{s.p="/"})(),(()=>{var e=(e,t,s,n)=>{var r=document.createElement("link");r.rel="stylesheet",r.type="text/css";var o=o=>{if(r.onerror=r.onload=null,"load"===o.type)s();else{var a=o&&("load"===o.type?"missing":o.type),i=o&&o.target&&o.target.href||t,l=new Error("Loading CSS chunk "+e+" failed.\n("+i+")");l.code="CSS_CHUNK_LOAD_FAILED",l.type=a,l.request=i,r.parentNode.removeChild(r),n(l)}};return r.onerror=r.onload=o,r.href=t,document.head.appendChild(r),r},t=(e,t)=>{for(var s=document.getElementsByTagName("link"),n=0;n<s.length;n++){var r=s[n],o=r.getAttribute("data-href")||r.getAttribute("href");if("stylesheet"===r.rel&&(o===e||o===t))return r}var a=document.getElementsByTagName("style");for(n=0;n<a.length;n++){r=a[n],o=r.getAttribute("data-href");if(o===e||o===t)return r}},n=n=>new Promise(((r,o)=>{var a=s.miniCssF(n),i=s.p+a;if(t(a,i))return r();e(n,i,r,o)})),r={143:0};s.f.miniCss=(e,t)=>{var s={57:1,184:1,313:1,379:1,419:1,441:1,532:1,558:1,575:1,684:1,701:1};r[e]?t.push(r[e]):0!==r[e]&&s[e]&&t.push(r[e]=n(e).then((()=>{r[e]=0}),(t=>{throw delete r[e],t})))}})(),(()=>{var e={143:0};s.f.j=(t,n)=>{var r=s.o(e,t)?e[t]:void 0;if(0!==r)if(r)n.push(r[2]);else{var o=new Promise(((s,n)=>r=e[t]=[s,n]));n.push(r[2]=o);var a=s.p+s.u(t),i=new Error,l=n=>{if(s.o(e,t)&&(r=e[t],0!==r&&(e[t]=void 0),r)){var o=n&&("load"===n.type?"missing":n.type),a=n&&n.target&&n.target.src;i.message="Loading chunk "+t+" failed.\n("+o+": "+a+")",i.name="ChunkLoadError",i.type=o,i.request=a,r[1](i)}};s.l(a,l,"chunk-"+t,t)}},s.O.j=t=>0===e[t];var t=(t,n)=>{var r,o,[a,i,l]=n,c=0;if(a.some((t=>0!==e[t]))){for(r in i)s.o(i,r)&&(s.m[r]=i[r]);if(l)var u=l(s)}for(t&&t(n);c<a.length;c++)o=a[c],s.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return s.O(u)},n=globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})();var n=s.O(void 0,[736],(()=>s(6618)));n=s.O(n)})();