(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[196],{7682:(s,t,e)=>{"use strict";e.d(t,{Z:()=>i});e(6727);var a=e(3701),l=e(9302);const{getScrollTarget:o,setVerticalScrollPosition:n}=a.ZP;(0,l.Z)();class i{static generateURLParams(s,t,e){return s.includes("?")?s+=`&${t}=${e}`:s+=`?${t}=${e}`,s}static scrollToElement(s,t=null){const e=o(s),a=null===t?s.offsetTop:t,l=500;n(e,a,l)}static loading(s,t=!0,e=null){t?s.$q.loading.show({message:null===e?"Loading ...":e}):s.$q.loading.hide()}}},8469:(s,t,e)=>{"use strict";e.r(t),e.d(t,{default:()=>F});var a=e(9835),l=e(6970);const o=s=>((0,a.dD)("data-v-ddb1e214"),s=s(),(0,a.Cn)(),s),n={class:"q-py-md q-py-xl bg-grey-2 q-px-sm q-px-md-xl"},i={class:"text-center text-h5 text-primary text-bold",ref:"tab"},r={class:"list-container page"},c={key:0,class:"q-gutter-md"},j={class:"row"},d={class:"col-7"},m=(0,a.Uk)(" High School  "),g={class:"capitalize"},u=o((()=>(0,a._)("div",{class:"col-5 text-center"}," Score ",-1))),h={class:"row q-mt-md"},p={class:"col-3 flex items-center justify-center"},b=["src"],y={class:"col-4 flex items-center q-pl-md"},f={class:"text-bold text-primary"},v={class:"col-5 flex items-center justify-center"},k={class:"text-primary text-bold text-h4"},w={class:"row q-mt-md"},z={class:"col-3 flex items-center justify-center"},_=["src"],x={class:"col-4 flex items-center q-pl-md"},$={class:"text-bold text-primary"},q={class:"col-5 flex items-center justify-center"},D={class:"text-primary text-bold text-h4"},Z={key:0},P={class:"text-center"},T={class:"flex items-center justify-between"},S={key:0,class:"flex items-center justify-center q-mt-xl"},U={key:1,class:"text-primary text-bold"};function C(s,t,e,o,C,L){const M=(0,a.up)("q-separator"),W=(0,a.up)("q-img"),O=(0,a.up)("q-card"),Q=(0,a.up)("q-btn");return(0,a.wg)(),(0,a.iD)("div",n,[(0,a._)("div",i," Last Week Scores ",512),(0,a._)("div",r,[s.data.length>0?((0,a.wg)(),(0,a.iD)("div",c,[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(s.data,(t=>((0,a.wg)(),(0,a.j4)(O,{key:t.id,flat:"",class:"bg-white q-pa-md",bordered:""},{default:(0,a.w5)((()=>[(0,a._)("div",j,[(0,a._)("div",d,[m,(0,a._)("span",g,(0,l.zw)(t.team_gender),1),(0,a.Uk)("  "+(0,l.zw)(t.sport_type.name),1)]),u]),(0,a.Wm)(M,{class:"q-mt-md"}),(0,a._)("div",h,[(0,a._)("div",p,[null!==t.school1.logo?((0,a.wg)(),(0,a.j4)(W,{key:0,class:"logo",src:`${s.$host}/storage/school/logo/${t.school1.logo}`,ratio:1},{error:(0,a.w5)((()=>[(0,a._)("img",{src:`${s.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,b)])),_:2},1032,["src"])):((0,a.wg)(),(0,a.j4)(W,{key:1,class:"logo",src:`${s.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"]))]),(0,a._)("div",y,[(0,a._)("div",f,(0,l.zw)(t.school1.name)+" ("+(0,l.zw)(t.school1.county.abbreviation)+") ",1)]),(0,a._)("div",v,[(0,a._)("div",k,(0,l.zw)(t.score1||"-"),1)])]),(0,a._)("div",w,[(0,a._)("div",z,[null!==t.school2.logo?((0,a.wg)(),(0,a.j4)(W,{key:0,class:"logo",src:`${s.$host}/storage/school/logo/${t.school2.logo}`,ratio:1},{error:(0,a.w5)((()=>[(0,a._)("img",{src:`${s.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,_)])),_:2},1032,["src"])):((0,a.wg)(),(0,a.j4)(W,{key:1,class:"logo",src:`${s.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"]))]),(0,a._)("div",x,[(0,a._)("div",$,(0,l.zw)(t.school2.name)+" ("+(0,l.zw)(t.school2.county.abbreviation)+") ",1)]),(0,a._)("div",q,[(0,a._)("div",D,(0,l.zw)(t.score2||"-"),1)])]),null!==t.stadium?((0,a.wg)(),(0,a.iD)("div",Z,[(0,a.Wm)(M,{class:"q-my-md"}),(0,a._)("div",P,(0,l.zw)(t.stadium),1)])):(0,a.kq)("",!0),(0,a.Wm)(M,{class:"q-my-md"}),(0,a._)("div",T,[(0,a._)("div",null,(0,l.zw)(L.scheduleDate(t.datetime)),1),(0,a._)("div",null,(0,l.zw)(L.scheduleTime(t.datetime)),1)])])),_:2},1024)))),128)),s.pagination.total_page>1?((0,a.wg)(),(0,a.iD)("div",S,[(0,a.Wm)(Q,{class:"",label:"See More",color:"primary",onClick:L.nextPage},null,8,["onClick"])])):(0,a.kq)("",!0)])):((0,a.wg)(),(0,a.iD)("div",U," No Data Available "))])])}e(4110),e(702),e(9829);var L=e(3878),M=e.n(L),W=e(7682),O=e(5457);const Q={data:function(){return{data:[],pagination:{page:1,total_page:1},loading:!0,id:this.$route.params.id}},mounted:function(){this.getData(),(0,O.Z)({title:"Score"})},methods:{nextPage:async function(){this.pagination.page=parseInt(this.pagination.page)+1,await this.getData()},back:function(){setTimeout((()=>{this.$router.push({name:"news"})}),500)},scheduleDate:function(s){const t=M().utc(s).local().format("dd, D MMMM Y");return t},scheduleTime:function(s){const t=M().utc(s).local().format("hh:mm"),e=M().tz.guess(),a=M().tz(e).zoneAbbr();return`${t} ${a}`},getData:function(s="have-played"){return W.Z.loading(this),new Promise(((t,e)=>{const a=this.pagination.page;let l="match-schedule/list";l=W.Z.generateURLParams(l,"page",a),l=W.Z.generateURLParams(l,"limit",10),l=W.Z.generateURLParams(l,"type",s),this.$api.get(l).then((s=>{const{data:l,message:o,status:n}=s.data;n?(this.data=a>1?this.data.concat(l.list):[...l.list],this.pagination={page:l.pagination.page,total_page:l.pagination.total_page},t()):e()})).finally((()=>{W.Z.loading(this,!1)}))}))}}};var R=e(1639),E=e(4458),I=e(2218),N=e(335),A=e(4455),H=e(9984),Y=e.n(H);const B=(0,R.Z)(Q,[["render",C],["__scopeId","data-v-ddb1e214"]]),F=B;Y()(Q,"components",{QCard:E.Z,QSeparator:I.Z,QImg:N.Z,QBtn:A.Z})},6700:(s,t,e)=>{var a={"./af":202,"./af.js":202,"./ar":6314,"./ar-dz":5666,"./ar-dz.js":5666,"./ar-kw":6591,"./ar-kw.js":6591,"./ar-ly":7900,"./ar-ly.js":7900,"./ar-ma":5667,"./ar-ma.js":5667,"./ar-sa":4092,"./ar-sa.js":4092,"./ar-tn":1379,"./ar-tn.js":1379,"./ar.js":6314,"./az":1699,"./az.js":1699,"./be":8988,"./be.js":8988,"./bg":7437,"./bg.js":7437,"./bm":7947,"./bm.js":7947,"./bn":2851,"./bn-bd":4905,"./bn-bd.js":4905,"./bn.js":2851,"./bo":7346,"./bo.js":7346,"./br":1711,"./br.js":1711,"./bs":3706,"./bs.js":3706,"./ca":112,"./ca.js":112,"./cs":6406,"./cs.js":6406,"./cv":1853,"./cv.js":1853,"./cy":9766,"./cy.js":9766,"./da":6836,"./da.js":6836,"./de":9320,"./de-at":4904,"./de-at.js":4904,"./de-ch":6710,"./de-ch.js":6710,"./de.js":9320,"./dv":3274,"./dv.js":3274,"./el":286,"./el.js":286,"./en-au":143,"./en-au.js":143,"./en-ca":237,"./en-ca.js":237,"./en-gb":2428,"./en-gb.js":2428,"./en-ie":3349,"./en-ie.js":3349,"./en-il":3764,"./en-il.js":3764,"./en-in":7809,"./en-in.js":7809,"./en-nz":9851,"./en-nz.js":9851,"./en-sg":5594,"./en-sg.js":5594,"./eo":4483,"./eo.js":4483,"./es":2184,"./es-do":5777,"./es-do.js":5777,"./es-mx":9356,"./es-mx.js":9356,"./es-us":8496,"./es-us.js":8496,"./es.js":2184,"./et":7578,"./et.js":7578,"./eu":2092,"./eu.js":2092,"./fa":5927,"./fa.js":5927,"./fi":171,"./fi.js":171,"./fil":2416,"./fil.js":2416,"./fo":9937,"./fo.js":9937,"./fr":5172,"./fr-ca":8249,"./fr-ca.js":8249,"./fr-ch":7541,"./fr-ch.js":7541,"./fr.js":5172,"./fy":7907,"./fy.js":7907,"./ga":6361,"./ga.js":6361,"./gd":2282,"./gd.js":2282,"./gl":2630,"./gl.js":2630,"./gom-deva":680,"./gom-deva.js":680,"./gom-latn":6220,"./gom-latn.js":6220,"./gu":6272,"./gu.js":6272,"./he":5540,"./he.js":5540,"./hi":6067,"./hi.js":6067,"./hr":9669,"./hr.js":9669,"./hu":3396,"./hu.js":3396,"./hy-am":6678,"./hy-am.js":6678,"./id":4812,"./id.js":4812,"./is":4193,"./is.js":4193,"./it":7863,"./it-ch":959,"./it-ch.js":959,"./it.js":7863,"./ja":1809,"./ja.js":1809,"./jv":8657,"./jv.js":8657,"./ka":3290,"./ka.js":3290,"./kk":8418,"./kk.js":8418,"./km":7687,"./km.js":7687,"./kn":1375,"./kn.js":1375,"./ko":2641,"./ko.js":2641,"./ku":3518,"./ku.js":3518,"./ky":5459,"./ky.js":5459,"./lb":1978,"./lb.js":1978,"./lo":6915,"./lo.js":6915,"./lt":8948,"./lt.js":8948,"./lv":2548,"./lv.js":2548,"./me":8608,"./me.js":8608,"./mi":333,"./mi.js":333,"./mk":6611,"./mk.js":6611,"./ml":999,"./ml.js":999,"./mn":4098,"./mn.js":4098,"./mr":6111,"./mr.js":6111,"./ms":3717,"./ms-my":265,"./ms-my.js":265,"./ms.js":3717,"./mt":8980,"./mt.js":8980,"./my":6895,"./my.js":6895,"./nb":5348,"./nb.js":5348,"./ne":1493,"./ne.js":1493,"./nl":4419,"./nl-be":5576,"./nl-be.js":5576,"./nl.js":4419,"./nn":6907,"./nn.js":6907,"./oc-lnc":2321,"./oc-lnc.js":2321,"./pa-in":9239,"./pa-in.js":9239,"./pl":7627,"./pl.js":7627,"./pt":5703,"./pt-br":1623,"./pt-br.js":1623,"./pt.js":5703,"./ro":2747,"./ro.js":2747,"./ru":4420,"./ru.js":4420,"./sd":2148,"./sd.js":2148,"./se":2461,"./se.js":2461,"./si":2783,"./si.js":2783,"./sk":3306,"./sk.js":3306,"./sl":341,"./sl.js":341,"./sq":2768,"./sq.js":2768,"./sr":2451,"./sr-cyrl":3371,"./sr-cyrl.js":3371,"./sr.js":2451,"./ss":8812,"./ss.js":8812,"./sv":3820,"./sv.js":3820,"./sw":3615,"./sw.js":3615,"./ta":2869,"./ta.js":2869,"./te":2044,"./te.js":2044,"./tet":5861,"./tet.js":5861,"./tg":6999,"./tg.js":6999,"./th":926,"./th.js":926,"./tk":7443,"./tk.js":7443,"./tl-ph":9786,"./tl-ph.js":9786,"./tlh":2812,"./tlh.js":2812,"./tr":6952,"./tr.js":6952,"./tzl":9573,"./tzl.js":9573,"./tzm":5990,"./tzm-latn":6961,"./tzm-latn.js":6961,"./tzm.js":5990,"./ug-cn":2610,"./ug-cn.js":2610,"./uk":9498,"./uk.js":9498,"./ur":3970,"./ur.js":3970,"./uz":9006,"./uz-latn":26,"./uz-latn.js":26,"./uz.js":9006,"./vi":9962,"./vi.js":9962,"./x-pseudo":8407,"./x-pseudo.js":8407,"./yo":1962,"./yo.js":1962,"./zh-cn":8909,"./zh-cn.js":8909,"./zh-hk":4014,"./zh-hk.js":4014,"./zh-mo":996,"./zh-mo.js":996,"./zh-tw":6327,"./zh-tw.js":6327};function l(s){var t=o(s);return e(t)}function o(s){if(!e.o(a,s)){var t=new Error("Cannot find module '"+s+"'");throw t.code="MODULE_NOT_FOUND",t}return a[s]}l.keys=function(){return Object.keys(a)},l.resolve=o,s.exports=l,l.id=6700}}]);