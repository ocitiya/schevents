(()=>{var e={6618:(e,s,t)=>{"use strict";t(8964),t(702);var r=t(1957),n=t(8266),o=t(499),a=t(9835);function i(e,s,t,r,n,o){const i=(0,a.up)("router-view");return(0,a.wg)(),(0,a.j4)(i)}const l=(0,a.aZ)({name:"App"});var c=t(1639);const u=(0,c.Z)(l,[["render",i]]),j=u;var d=t(3340),h=t(2502);const p=(0,d.h)((()=>{const e=(0,h.WB)();return e}));var m=t(8339);const f=[{path:"/",component:()=>Promise.all([t.e(736),t.e(287)]).then(t.bind(t,1287)),children:[{path:"",name:"home",component:()=>Promise.all([t.e(736),t.e(731)]).then(t.bind(t,731))},{path:"club",name:"club",component:()=>Promise.all([t.e(736),t.e(727)]).then(t.bind(t,9727))},{path:"about",name:"about",component:()=>Promise.all([t.e(736),t.e(565)]).then(t.bind(t,6565))},{path:"scores",name:"scores",component:()=>Promise.all([t.e(736),t.e(441)]).then(t.bind(t,7441))},{path:"news",name:"news",component:()=>Promise.all([t.e(736),t.e(934)]).then(t.bind(t,934))},{path:"news/:id",name:"news.detail",component:()=>Promise.all([t.e(736),t.e(379)]).then(t.bind(t,3379))},{path:"video",name:"video",component:()=>Promise.all([t.e(736),t.e(558)]).then(t.bind(t,558))}]},{path:"/:catchAll(.*)*",component:()=>Promise.all([t.e(736),t.e(862)]).then(t.bind(t,1862))}],b=f,v=(0,d.BC)((function(){const e=m.PO,s=(0,m.p7)({scrollBehavior:()=>({left:0,top:0}),routes:b,history:e("/")});return s}));async function g(e,s){const t=e(j);t.use(n.Z,s);const r="function"===typeof p?await p({}):p;t.use(r);const a=(0,o.Xl)("function"===typeof v?await v({store:r}):v);return r.use((({store:e})=>{e.router=a})),{app:t,store:r,router:a}}var y=t(6950),k=t(6229);const w={config:{},plugins:{Loading:y.Z,Meta:k.ZP}},P="/";async function z({app:e,router:s,store:t},r){let n=!1;const o=e=>{try{return s.resolve(e).href}catch(t){}return Object(e)===e?null:e},a=e=>{if(n=!0,"string"===typeof e&&/^https?:\/\//.test(e))return void(window.location.href=e);const s=o(e);null!==s&&(window.location.href=s)},i=window.location.href.replace(window.location.origin,"");for(let c=0;!1===n&&c<r.length;c++)try{await r[c]({app:e,router:s,store:t,ssrContext:null,redirect:a,urlPath:i,publicPath:P})}catch(l){return l&&l.url?void a(l.url):void console.error("[Quasar] boot error:",l)}!0!==n&&(e.use(s),e.mount("#q-app"))}g(r.ri,w).then((e=>Promise.all([Promise.resolve().then(t.bind(t,6288)),Promise.resolve().then(t.bind(t,1569))]).then((s=>{const t=s.map((e=>e.default)).filter((e=>"function"===typeof e));z(e,t)}))))},1569:(e,s,t)=>{"use strict";t.r(s),t.d(s,{api:()=>u,default:()=>j});var r=t(3340),n=t(9981),o=t.n(n),a=(t(9829),t(3878)),i=t.n(a);const l=i().tz.guess(),c="https://live.schsports.com",u=o().create({baseURL:`${c}/api`,headers:{Timezone:l}});u.interceptors.request.use((function(e){return e}),(function(e){return Promise.reject(e)}));const j=(0,r.xr)((({app:e})=>{e.config.globalProperties.$host=c,e.config.globalProperties.$axios=o(),e.config.globalProperties.$api=u}))},6288:(e,s,t)=>{"use strict";t.r(s),t.d(s,{default:()=>i});var r=t(3340),n=t(9991);const o={failed:"Action failed",success:"Action was successful"},a={"en-US":o},i=(0,r.xr)((({app:e})=>{const s=(0,n.o)({locale:"en-US",messages:a});e.use(s)}))},6700:(e,s,t)=>{var r={"./af":202,"./af.js":202,"./ar":6314,"./ar-dz":5666,"./ar-dz.js":5666,"./ar-kw":6591,"./ar-kw.js":6591,"./ar-ly":7900,"./ar-ly.js":7900,"./ar-ma":5667,"./ar-ma.js":5667,"./ar-sa":4092,"./ar-sa.js":4092,"./ar-tn":6916,"./ar-tn.js":6916,"./ar.js":6314,"./az":1699,"./az.js":1699,"./be":8988,"./be.js":8988,"./bg":7437,"./bg.js":7437,"./bm":7947,"./bm.js":7947,"./bn":2851,"./bn-bd":4905,"./bn-bd.js":4905,"./bn.js":2851,"./bo":7346,"./bo.js":7346,"./br":1711,"./br.js":1711,"./bs":3706,"./bs.js":3706,"./ca":112,"./ca.js":112,"./cs":6406,"./cs.js":6406,"./cv":1853,"./cv.js":1853,"./cy":9766,"./cy.js":9766,"./da":6836,"./da.js":6836,"./de":9320,"./de-at":4904,"./de-at.js":4904,"./de-ch":6710,"./de-ch.js":6710,"./de.js":9320,"./dv":3274,"./dv.js":3274,"./el":286,"./el.js":286,"./en-au":143,"./en-au.js":143,"./en-ca":237,"./en-ca.js":237,"./en-gb":2428,"./en-gb.js":2428,"./en-ie":3349,"./en-ie.js":3349,"./en-il":3764,"./en-il.js":3764,"./en-in":7809,"./en-in.js":7809,"./en-nz":9851,"./en-nz.js":9851,"./en-sg":5594,"./en-sg.js":5594,"./eo":4483,"./eo.js":4483,"./es":2184,"./es-do":5777,"./es-do.js":5777,"./es-mx":9356,"./es-mx.js":9356,"./es-us":8496,"./es-us.js":8496,"./es.js":2184,"./et":7578,"./et.js":7578,"./eu":2092,"./eu.js":2092,"./fa":5927,"./fa.js":5927,"./fi":171,"./fi.js":171,"./fil":2416,"./fil.js":2416,"./fo":9937,"./fo.js":9937,"./fr":5172,"./fr-ca":8249,"./fr-ca.js":8249,"./fr-ch":7541,"./fr-ch.js":7541,"./fr.js":5172,"./fy":7907,"./fy.js":7907,"./ga":6361,"./ga.js":6361,"./gd":2282,"./gd.js":2282,"./gl":2630,"./gl.js":2630,"./gom-deva":680,"./gom-deva.js":680,"./gom-latn":6220,"./gom-latn.js":6220,"./gu":6272,"./gu.js":6272,"./he":5540,"./he.js":5540,"./hi":6067,"./hi.js":6067,"./hr":9669,"./hr.js":9669,"./hu":3396,"./hu.js":3396,"./hy-am":6678,"./hy-am.js":6678,"./id":4812,"./id.js":4812,"./is":4193,"./is.js":4193,"./it":7863,"./it-ch":959,"./it-ch.js":959,"./it.js":7863,"./ja":1809,"./ja.js":1809,"./jv":8657,"./jv.js":8657,"./ka":3290,"./ka.js":3290,"./kk":8418,"./kk.js":8418,"./km":7687,"./km.js":7687,"./kn":1375,"./kn.js":1375,"./ko":2641,"./ko.js":2641,"./ku":3518,"./ku.js":3518,"./ky":5459,"./ky.js":5459,"./lb":1978,"./lb.js":1978,"./lo":6915,"./lo.js":6915,"./lt":8948,"./lt.js":8948,"./lv":2548,"./lv.js":2548,"./me":8608,"./me.js":8608,"./mi":333,"./mi.js":333,"./mk":6611,"./mk.js":6611,"./ml":999,"./ml.js":999,"./mn":4098,"./mn.js":4098,"./mr":6111,"./mr.js":6111,"./ms":3717,"./ms-my":265,"./ms-my.js":265,"./ms.js":3717,"./mt":8980,"./mt.js":8980,"./my":6895,"./my.js":6895,"./nb":5348,"./nb.js":5348,"./ne":1493,"./ne.js":1493,"./nl":4419,"./nl-be":5576,"./nl-be.js":5576,"./nl.js":4419,"./nn":6907,"./nn.js":6907,"./oc-lnc":2321,"./oc-lnc.js":2321,"./pa-in":9239,"./pa-in.js":9239,"./pl":7627,"./pl.js":7627,"./pt":5703,"./pt-br":1623,"./pt-br.js":1623,"./pt.js":5703,"./ro":2747,"./ro.js":2747,"./ru":4420,"./ru.js":4420,"./sd":2148,"./sd.js":2148,"./se":2461,"./se.js":2461,"./si":2783,"./si.js":2783,"./sk":3306,"./sk.js":3306,"./sl":341,"./sl.js":341,"./sq":2768,"./sq.js":2768,"./sr":2451,"./sr-cyrl":3371,"./sr-cyrl.js":3371,"./sr.js":2451,"./ss":8812,"./ss.js":8812,"./sv":3820,"./sv.js":3820,"./sw":3615,"./sw.js":3615,"./ta":2869,"./ta.js":2869,"./te":2044,"./te.js":2044,"./tet":5861,"./tet.js":5861,"./tg":6999,"./tg.js":6999,"./th":926,"./th.js":926,"./tk":7443,"./tk.js":7443,"./tl-ph":9786,"./tl-ph.js":9786,"./tlh":2812,"./tlh.js":2812,"./tr":6952,"./tr.js":6952,"./tzl":9573,"./tzl.js":9573,"./tzm":5990,"./tzm-latn":6961,"./tzm-latn.js":6961,"./tzm.js":5990,"./ug-cn":2610,"./ug-cn.js":2610,"./uk":9498,"./uk.js":9498,"./ur":3970,"./ur.js":3970,"./uz":9006,"./uz-latn":26,"./uz-latn.js":26,"./uz.js":9006,"./vi":9962,"./vi.js":9962,"./x-pseudo":8407,"./x-pseudo.js":8407,"./yo":1962,"./yo.js":1962,"./zh-cn":8909,"./zh-cn.js":8909,"./zh-hk":4014,"./zh-hk.js":4014,"./zh-mo":996,"./zh-mo.js":996,"./zh-tw":6327,"./zh-tw.js":6327};function n(e){var s=o(e);return t(s)}function o(e){if(!t.o(r,e)){var s=new Error("Cannot find module '"+e+"'");throw s.code="MODULE_NOT_FOUND",s}return r[e]}n.keys=function(){return Object.keys(r)},n.resolve=o,e.exports=n,n.id=6700}},s={};function t(r){var n=s[r];if(void 0!==n)return n.exports;var o=s[r]={id:r,loaded:!1,exports:{}};return e[r].call(o.exports,o,o.exports,t),o.loaded=!0,o.exports}t.m=e,(()=>{var e=[];t.O=(s,r,n,o)=>{if(!r){var a=1/0;for(u=0;u<e.length;u++){for(var[r,n,o]=e[u],i=!0,l=0;l<r.length;l++)(!1&o||a>=o)&&Object.keys(t.O).every((e=>t.O[e](r[l])))?r.splice(l--,1):(i=!1,o<a&&(a=o));if(i){e.splice(u--,1);var c=n();void 0!==c&&(s=c)}}return s}o=o||0;for(var u=e.length;u>0&&e[u-1][2]>o;u--)e[u]=e[u-1];e[u]=[r,n,o]}})(),(()=>{t.n=e=>{var s=e&&e.__esModule?()=>e["default"]:()=>e;return t.d(s,{a:s}),s}})(),(()=>{t.d=(e,s)=>{for(var r in s)t.o(s,r)&&!t.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:s[r]})}})(),(()=>{t.f={},t.e=e=>Promise.all(Object.keys(t.f).reduce(((s,r)=>(t.f[r](e,s),s)),[]))})(),(()=>{t.u=e=>"js/"+e+"."+{287:"961feaf3",379:"f91839c1",441:"41c27766",558:"51714f25",565:"9a4397dd",727:"c91aea12",731:"9e215b73",862:"89b1984d",934:"50f8aecd"}[e]+".js"})(),(()=>{t.miniCssF=e=>"css/"+({143:"app",736:"vendor"}[e]||e)+"."+{143:"c589a4fc",287:"38c4cbae",379:"3ac9b42d",441:"b2898fc9",558:"8d24de49",565:"8916b239",727:"801f358c",731:"7523f57d",736:"1b391680",934:"0beafd82"}[e]+".css"})(),(()=>{t.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"===typeof window)return window}}()})(),(()=>{t.o=(e,s)=>Object.prototype.hasOwnProperty.call(e,s)})(),(()=>{var e={},s="home-app:";t.l=(r,n,o,a)=>{if(e[r])e[r].push(n);else{var i,l;if(void 0!==o)for(var c=document.getElementsByTagName("script"),u=0;u<c.length;u++){var j=c[u];if(j.getAttribute("src")==r||j.getAttribute("data-webpack")==s+o){i=j;break}}i||(l=!0,i=document.createElement("script"),i.charset="utf-8",i.timeout=120,t.nc&&i.setAttribute("nonce",t.nc),i.setAttribute("data-webpack",s+o),i.src=r),e[r]=[n];var d=(s,t)=>{i.onerror=i.onload=null,clearTimeout(h);var n=e[r];if(delete e[r],i.parentNode&&i.parentNode.removeChild(i),n&&n.forEach((e=>e(t))),s)return s(t)},h=setTimeout(d.bind(null,void 0,{type:"timeout",target:i}),12e4);i.onerror=d.bind(null,i.onerror),i.onload=d.bind(null,i.onload),l&&document.head.appendChild(i)}}})(),(()=>{t.r=e=>{"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}})(),(()=>{t.nmd=e=>(e.paths=[],e.children||(e.children=[]),e)})(),(()=>{t.p="/"})(),(()=>{var e=(e,s,t,r)=>{var n=document.createElement("link");n.rel="stylesheet",n.type="text/css";var o=o=>{if(n.onerror=n.onload=null,"load"===o.type)t();else{var a=o&&("load"===o.type?"missing":o.type),i=o&&o.target&&o.target.href||s,l=new Error("Loading CSS chunk "+e+" failed.\n("+i+")");l.code="CSS_CHUNK_LOAD_FAILED",l.type=a,l.request=i,n.parentNode.removeChild(n),r(l)}};return n.onerror=n.onload=o,n.href=s,document.head.appendChild(n),n},s=(e,s)=>{for(var t=document.getElementsByTagName("link"),r=0;r<t.length;r++){var n=t[r],o=n.getAttribute("data-href")||n.getAttribute("href");if("stylesheet"===n.rel&&(o===e||o===s))return n}var a=document.getElementsByTagName("style");for(r=0;r<a.length;r++){n=a[r],o=n.getAttribute("data-href");if(o===e||o===s)return n}},r=r=>new Promise(((n,o)=>{var a=t.miniCssF(r),i=t.p+a;if(s(a,i))return n();e(r,i,n,o)})),n={143:0};t.f.miniCss=(e,s)=>{var t={287:1,379:1,441:1,558:1,565:1,727:1,731:1,934:1};n[e]?s.push(n[e]):0!==n[e]&&t[e]&&s.push(n[e]=r(e).then((()=>{n[e]=0}),(s=>{throw delete n[e],s})))}})(),(()=>{var e={143:0};t.f.j=(s,r)=>{var n=t.o(e,s)?e[s]:void 0;if(0!==n)if(n)r.push(n[2]);else{var o=new Promise(((t,r)=>n=e[s]=[t,r]));r.push(n[2]=o);var a=t.p+t.u(s),i=new Error,l=r=>{if(t.o(e,s)&&(n=e[s],0!==n&&(e[s]=void 0),n)){var o=r&&("load"===r.type?"missing":r.type),a=r&&r.target&&r.target.src;i.message="Loading chunk "+s+" failed.\n("+o+": "+a+")",i.name="ChunkLoadError",i.type=o,i.request=a,n[1](i)}};t.l(a,l,"chunk-"+s,s)}},t.O.j=s=>0===e[s];var s=(s,r)=>{var n,o,[a,i,l]=r,c=0;if(a.some((s=>0!==e[s]))){for(n in i)t.o(i,n)&&(t.m[n]=i[n]);if(l)var u=l(t)}for(s&&s(r);c<a.length;c++)o=a[c],t.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return t.O(u)},r=globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[];r.forEach(s.bind(null,0)),r.push=s.bind(null,r.push.bind(r))})();var r=t.O(void 0,[736],(()=>t(6618)));r=t.O(r)})();