(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[819],{3379:(s,t,a)=>{"use strict";a.r(t),a.d(t,{default:()=>S});var e=a(9835),o=a(6970);const l=s=>((0,e.dD)("data-v-67397bb9"),s=s(),(0,e.Cn)(),s),n={class:"q-px-md q-py-xl page"},i={key:0},c={class:"text-center text-h5 text-primary text-bold"},r={class:"list-container"},d={class:""},j={class:"text-bold text-primary text-h6"},h={key:0},m={key:1},u={class:"card-score q-mt-xl"},g=["src"],k={class:"school"},y={class:"text-body1 text-primary"},p={class:"text-bold"},b=l((()=>(0,e._)("div",null,"vs",-1))),w={class:"text-body1 text-primary"},v={class:"text-bold"},z={class:"text-subtitle2"},f={key:0},_={key:1,class:"capitalize"},$={class:"flex flex-center q-mt-lg"},x=["src"],D=["src"];function q(s,t,a,l,q,T){const C=(0,e.up)("q-img"),M=(0,e.up)("q-card"),O=(0,e.up)("q-btn");return(0,e.wg)(),(0,e.iD)("div",n,[Object.keys(s.data).length>0?((0,e.wg)(),(0,e.iD)("div",i,[(0,e._)("div",c,(0,o.zw)(s.data.school1.name)+" ("+(0,o.zw)(s.data.school1.county.name)+") vs "+(0,o.zw)(s.data.school2.name)+" ("+(0,o.zw)(s.data.school2.county.name)+") ",1),(0,e._)("div",r,[(0,e._)("div",d,[(0,e.Wm)(M,{class:"q-pa-md",flat:""},{default:(0,e.w5)((()=>[(0,e._)("div",j,[null!==s.data.sport_type?((0,e.wg)(),(0,e.iD)("div",h,"HS "+(0,o.zw)(s.data.sport_type.name)+" Games",1)):((0,e.wg)(),(0,e.iD)("div",m,"Unknown Sport"))]),(0,e._)("div",u,[null!==s.data.school1.logo?((0,e.wg)(),(0,e.j4)(C,{key:0,class:"logo",src:`${s.$host}/storage/school/logo/${s.data.school1.logo}`,ratio:1},{error:(0,e.w5)((()=>[(0,e._)("img",{src:`${s.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,g)])),_:1},8,["src"])):((0,e.wg)(),(0,e.j4)(C,{key:1,class:"logo",src:`${s.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,e._)("div",null,[(0,e._)("div",k,[(0,e._)("div",y,[(0,e._)("div",null,(0,o.zw)(s.data.school1.name)+" ("+(0,o.zw)(s.data.school1.county.name)+")",1),(0,e._)("div",p,(0,o.zw)(s.data.school1.score||"-"),1)]),b,(0,e._)("div",w,[(0,e._)("div",null,(0,o.zw)(s.data.school2.name)+" ("+(0,o.zw)(s.data.school2.county.name)+")",1),(0,e._)("div",v,(0,o.zw)(s.data.school2.score||"-"),1)])]),(0,e._)("div",z,[(0,e.Uk)((0,o.zw)(T.scheduleDate(s.data.datetime))+" | "+(0,o.zw)(T.scheduleTime(s.data.datetime))+" ",1),null!==s.data.stadium?((0,e.wg)(),(0,e.iD)("span",f," | "+(0,o.zw)(s.data.stadium),1)):(0,e.kq)("",!0),null!==s.data.team_gender?((0,e.wg)(),(0,e.iD)("span",_," | "+(0,o.zw)(s.data.team_gender),1)):(0,e.kq)("",!0)]),(0,e._)("div",$,[null!==s.data.youtube_link?((0,e.wg)(),(0,e.iD)("iframe",{key:0,height:"100",width:"178",src:s.data.youtube_link,title:"YouTube video player",frameborder:"0",allow:"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture",allowfullscreen:""},null,8,x)):((0,e.wg)(),(0,e.j4)(C,{key:1,src:`${s.$host}/images/no-video.jpg`,ratio:16/9,style:{height:"100px",width:"178px"}},null,8,["src"]))])]),null!==s.data.school2.logo?((0,e.wg)(),(0,e.j4)(C,{key:2,class:"logo",src:`${s.$host}/storage/school/logo/${s.data.school2.logo}`,ratio:1},{error:(0,e.w5)((()=>[(0,e._)("img",{src:`${s.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,D)])),_:1},8,["src"])):((0,e.wg)(),(0,e.j4)(C,{key:3,class:"logo",src:`${s.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"]))])])),_:1}),(0,e.Wm)(O,{unelevated:"",color:"primary",label:"Back to News",icon:"arrow_back",class:"q-mt-md",onClick:T.back},null,8,["onClick"])])])])):(0,e.kq)("",!0)])}a(4110),a(9829);var T=a(3878),C=a.n(T),M=a(5457);const O={data:function(){return{data:{},loading:!0,id:this.$route.params.id}},mounted:async function(){await this.getData();const s=`${this.data.school1.name} (${this.data.school1.county.name}) vs ${this.data.school2.name} (${this.data.school2.county.name})`,t=this.scheduleDate(this.data.datetime),a=this.scheduleTime(this.data.datetime),e=null===this.data.stadium?"":this.data.stadium;(0,M.Z)({title:s,meta:{description:{name:"description",content:`${s}, ${t}, ${a}, ${e}, ${this.data.team_gender}`},keywords:{name:"keywords",content:this.data.keywords}}})},methods:{back:function(){setTimeout((()=>{this.$router.push({name:"news"})}),500)},scheduleDate:function(s){const t=C().utc(s).local().format("dd, D MMMM Y");return t},scheduleTime:function(s){const t=C().utc(s).local().format("hh:mm"),a=C().tz.guess(),e=C().tz(a).zoneAbbr();return`${t} ${e}`},getData:function(){return this.loading=!0,new Promise(((s,t)=>{let a=`match-schedule/detail/${this.id}`;this.$api.get(a).then((t=>{const{data:a,message:e,status:o}=t.data;o&&(this.data={...a},s())})).finally((()=>{this.loading=!1}))}))}}};var Z=a(1639),U=a(4458),N=a(335),Q=a(4455),B=a(9984),E=a.n(B);const I=(0,Z.Z)(O,[["render",q],["__scopeId","data-v-67397bb9"]]),S=I;E()(O,"components",{QCard:U.Z,QImg:N.Z,QBtn:Q.Z})},6700:(s,t,a)=>{var e={"./af":202,"./af.js":202,"./ar":6314,"./ar-dz":5666,"./ar-dz.js":5666,"./ar-kw":6591,"./ar-kw.js":6591,"./ar-ly":7900,"./ar-ly.js":7900,"./ar-ma":5667,"./ar-ma.js":5667,"./ar-sa":4092,"./ar-sa.js":4092,"./ar-tn":1379,"./ar-tn.js":1379,"./ar.js":6314,"./az":1699,"./az.js":1699,"./be":8988,"./be.js":8988,"./bg":7437,"./bg.js":7437,"./bm":7947,"./bm.js":7947,"./bn":2851,"./bn-bd":4905,"./bn-bd.js":4905,"./bn.js":2851,"./bo":7346,"./bo.js":7346,"./br":1711,"./br.js":1711,"./bs":3706,"./bs.js":3706,"./ca":112,"./ca.js":112,"./cs":6406,"./cs.js":6406,"./cv":1853,"./cv.js":1853,"./cy":9766,"./cy.js":9766,"./da":6836,"./da.js":6836,"./de":9320,"./de-at":4904,"./de-at.js":4904,"./de-ch":6710,"./de-ch.js":6710,"./de.js":9320,"./dv":3274,"./dv.js":3274,"./el":286,"./el.js":286,"./en-au":143,"./en-au.js":143,"./en-ca":237,"./en-ca.js":237,"./en-gb":2428,"./en-gb.js":2428,"./en-ie":3349,"./en-ie.js":3349,"./en-il":3764,"./en-il.js":3764,"./en-in":7809,"./en-in.js":7809,"./en-nz":9851,"./en-nz.js":9851,"./en-sg":5594,"./en-sg.js":5594,"./eo":4483,"./eo.js":4483,"./es":2184,"./es-do":5777,"./es-do.js":5777,"./es-mx":9356,"./es-mx.js":9356,"./es-us":8496,"./es-us.js":8496,"./es.js":2184,"./et":7578,"./et.js":7578,"./eu":2092,"./eu.js":2092,"./fa":5927,"./fa.js":5927,"./fi":171,"./fi.js":171,"./fil":2416,"./fil.js":2416,"./fo":9937,"./fo.js":9937,"./fr":5172,"./fr-ca":8249,"./fr-ca.js":8249,"./fr-ch":7541,"./fr-ch.js":7541,"./fr.js":5172,"./fy":7907,"./fy.js":7907,"./ga":6361,"./ga.js":6361,"./gd":2282,"./gd.js":2282,"./gl":2630,"./gl.js":2630,"./gom-deva":680,"./gom-deva.js":680,"./gom-latn":6220,"./gom-latn.js":6220,"./gu":6272,"./gu.js":6272,"./he":5540,"./he.js":5540,"./hi":6067,"./hi.js":6067,"./hr":9669,"./hr.js":9669,"./hu":3396,"./hu.js":3396,"./hy-am":6678,"./hy-am.js":6678,"./id":4812,"./id.js":4812,"./is":4193,"./is.js":4193,"./it":7863,"./it-ch":959,"./it-ch.js":959,"./it.js":7863,"./ja":1809,"./ja.js":1809,"./jv":8657,"./jv.js":8657,"./ka":3290,"./ka.js":3290,"./kk":8418,"./kk.js":8418,"./km":7687,"./km.js":7687,"./kn":1375,"./kn.js":1375,"./ko":2641,"./ko.js":2641,"./ku":3518,"./ku.js":3518,"./ky":5459,"./ky.js":5459,"./lb":1978,"./lb.js":1978,"./lo":6915,"./lo.js":6915,"./lt":8948,"./lt.js":8948,"./lv":2548,"./lv.js":2548,"./me":8608,"./me.js":8608,"./mi":333,"./mi.js":333,"./mk":6611,"./mk.js":6611,"./ml":999,"./ml.js":999,"./mn":4098,"./mn.js":4098,"./mr":6111,"./mr.js":6111,"./ms":3717,"./ms-my":265,"./ms-my.js":265,"./ms.js":3717,"./mt":8980,"./mt.js":8980,"./my":6895,"./my.js":6895,"./nb":5348,"./nb.js":5348,"./ne":1493,"./ne.js":1493,"./nl":4419,"./nl-be":5576,"./nl-be.js":5576,"./nl.js":4419,"./nn":6907,"./nn.js":6907,"./oc-lnc":2321,"./oc-lnc.js":2321,"./pa-in":9239,"./pa-in.js":9239,"./pl":7627,"./pl.js":7627,"./pt":5703,"./pt-br":1623,"./pt-br.js":1623,"./pt.js":5703,"./ro":2747,"./ro.js":2747,"./ru":4420,"./ru.js":4420,"./sd":2148,"./sd.js":2148,"./se":2461,"./se.js":2461,"./si":2783,"./si.js":2783,"./sk":3306,"./sk.js":3306,"./sl":341,"./sl.js":341,"./sq":2768,"./sq.js":2768,"./sr":2451,"./sr-cyrl":3371,"./sr-cyrl.js":3371,"./sr.js":2451,"./ss":8812,"./ss.js":8812,"./sv":3820,"./sv.js":3820,"./sw":3615,"./sw.js":3615,"./ta":2869,"./ta.js":2869,"./te":2044,"./te.js":2044,"./tet":5861,"./tet.js":5861,"./tg":6999,"./tg.js":6999,"./th":926,"./th.js":926,"./tk":7443,"./tk.js":7443,"./tl-ph":9786,"./tl-ph.js":9786,"./tlh":2812,"./tlh.js":2812,"./tr":6952,"./tr.js":6952,"./tzl":9573,"./tzl.js":9573,"./tzm":5990,"./tzm-latn":6961,"./tzm-latn.js":6961,"./tzm.js":5990,"./ug-cn":2610,"./ug-cn.js":2610,"./uk":9498,"./uk.js":9498,"./ur":3970,"./ur.js":3970,"./uz":9006,"./uz-latn":26,"./uz-latn.js":26,"./uz.js":9006,"./vi":9962,"./vi.js":9962,"./x-pseudo":8407,"./x-pseudo.js":8407,"./yo":1962,"./yo.js":1962,"./zh-cn":8909,"./zh-cn.js":8909,"./zh-hk":4014,"./zh-hk.js":4014,"./zh-mo":996,"./zh-mo.js":996,"./zh-tw":6327,"./zh-tw.js":6327};function o(s){var t=l(s);return a(t)}function l(s){if(!a.o(e,s)){var t=new Error("Cannot find module '"+s+"'");throw t.code="MODULE_NOT_FOUND",t}return e[s]}o.keys=function(){return Object.keys(e)},o.resolve=l,s.exports=o,o.id=6700}}]);