(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[884],{7682:(e,s,t)=>{"use strict";t.d(s,{Z:()=>i});t(6727);var l=t(3701);const{getScrollTarget:a,setVerticalScrollPosition:o}=l.ZP;class i{static generateURLParams(e,s,t){return e.includes("?")?e+=`&${s}=${t}`:e+=`?${s}=${t}`,e}static scrollToElement(e,s=null){const t=a(e),l=null===s?e.offsetTop:s,i=500;o(t,l,i)}}},5654:(e,s,t)=>{"use strict";t.r(s),t.d(s,{default:()=>fe});var l=t(9835),a=t(6970);const o=e=>((0,l.dD)("data-v-191e13dc"),e=e(),(0,l.Cn)(),e),i=o((()=>(0,l._)("div",{class:"bg-primary text-white page-title flex flex-center"},[(0,l._)("div",{class:"text-h4"}," schsports.com "),(0,l._)("div",{class:"text-subtitle1 q-mt-lg"}," Find American School Sports Match Schedule ")],-1))),n=o((()=>(0,l._)("svg",{id:"visual",class:"bg-grey-2 title-waves",viewBox:"0 0 900 200",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink",version:"1.1"},[(0,l._)("path",{d:"M0 62L10.7 60.5C21.3 59 42.7 56 64.2 59C85.7 62 107.3 71 128.8 75.5C150.3 80 171.7 80 193 73.5C214.3 67 235.7 54 257 52.7C278.3 51.3 299.7 61.7 321.2 68.5C342.7 75.3 364.3 78.7 385.8 75.3C407.3 72 428.7 62 450 56.5C471.3 51 492.7 50 514.2 50.7C535.7 51.3 557.3 53.7 578.8 55.7C600.3 57.7 621.7 59.3 643 62.5C664.3 65.7 685.7 70.3 707 68.3C728.3 66.3 749.7 57.7 771.2 54.2C792.7 50.7 814.3 52.3 835.8 56C857.3 59.7 878.7 65.3 889.3 68.2L900 71L900 0L889.3 0C878.7 0 857.3 0 835.8 0C814.3 0 792.7 0 771.2 0C749.7 0 728.3 0 707 0C685.7 0 664.3 0 643 0C621.7 0 600.3 0 578.8 0C557.3 0 535.7 0 514.2 0C492.7 0 471.3 0 450 0C428.7 0 407.3 0 385.8 0C364.3 0 342.7 0 321.2 0C299.7 0 278.3 0 257 0C235.7 0 214.3 0 193 0C171.7 0 150.3 0 128.8 0C107.3 0 85.7 0 64.2 0C42.7 0 21.3 0 10.7 0L0 0Z",fill:"#ec7505","stroke-linecap":"round","stroke-linejoin":"miter"})],-1))),r={class:"text-right bg-grey-2 q-py-md options-container",style:{"margin-top":"-20px"}},c={class:"q-pt-xl page bg-grey-2"},d={key:0},h={class:"card-schedule-container"},m={class:"text-primary"},u={key:0,class:"capitalize"},g={key:1},p={key:2},j={class:"vs-section q-mb-md"},f={key:0,class:"text-center q-mr-md"},w=["src"],b={class:"text-bold text-primary q-mt-md"},y={key:1,class:"q-ml-md flex flex-center"},v=o((()=>(0,l._)("div",{class:"text-red text-bold"},"Unknown School",-1))),k=[v],_=o((()=>(0,l._)("div",{class:"text-body1 text-grey-7 flex flex-center"}," VS ",-1))),x={key:2,class:"text-center q-ml-md"},C=["src"],q={class:"text-bold text-primary q-mt-md"},z={key:3,class:"q-ml-md flex flex-center"},S=o((()=>(0,l._)("div",{class:"text-red text-bold"},"Unknown School",-1))),Z=[S],W={key:0},D={class:"flex items-center text-primary q-mt-md"},$={class:"flex flex-center"},F={class:"q-ml-sm"},Q={class:"flex flex-center"},L={class:"q-ml-sm"},U={class:"flex flex-center q-py-md"},T={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function P(e,s,t,o,v,S){const P=(0,l.up)("q-badge"),V=(0,l.up)("q-btn"),M=(0,l.up)("q-tab"),I=(0,l.up)("q-tabs"),R=(0,l.up)("q-card-section"),O=(0,l.up)("q-separator"),B=(0,l.up)("q-img"),E=(0,l.up)("q-icon"),H=(0,l.up)("q-card"),N=(0,l.up)("q-spinner-dots"),A=(0,l.up)("q-infinite-scroll"),J=(0,l.up)("q-inner-loading"),Y=(0,l.up)("q-pull-to-refresh"),K=(0,l.up)("match-filter"),G=(0,l.up)("q-page"),X=(0,l.Q2)("ripple");return(0,l.wg)(),(0,l.j4)(G,null,{default:(0,l.w5)((()=>[i,n,(0,l._)("div",r,[(0,l.Wm)(V,{label:"filter",icon:"filter_alt",unelevated:"",color:"primary",onClick:e.showFilterDialog},{default:(0,l.w5)((()=>[e.has_filter?((0,l.wg)(),(0,l.j4)(P,{key:0,floating:"",color:"white",rounded:""})):(0,l.kq)("",!0)])),_:1},8,["onClick"])]),(0,l.Wm)(I,{modelValue:e.tab,"onUpdate:modelValue":[s[0]||(s[0]=s=>e.tab=s),e.getSchedule],"inline-label":"",class:"bg-grey-2","active-class":"bg-primary text-white"},{default:(0,l.w5)((()=>[(0,l.Wm)(M,{name:"live",label:"Live"}),(0,l.Wm)(M,{name:"upcoming",label:"Upcoming"}),(0,l.Wm)(M,{name:"this-week",label:"This Week"}),(0,l.Wm)(M,{name:"today",label:"Today"})])),_:1},8,["modelValue","onUpdate:modelValue"]),(0,l.Wm)(Y,{onRefresh:e.refresh},{default:(0,l.w5)((()=>[(0,l._)("div",c,[e.schedules.length>0?((0,l.wg)(),(0,l.iD)("div",d,[(0,l.Wm)(A,{onLoad:e.loadMore},{loading:(0,l.w5)((()=>[(0,l._)("div",U,[(0,l.Wm)(N,{color:"primary",size:"40px"})])])),default:(0,l.w5)((()=>[(0,l._)("div",h,[((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(e.schedules,(s=>((0,l.wg)(),(0,l.iD)("div",{key:s.id},[(0,l.wy)(((0,l.wg)(),(0,l.j4)(H,{class:"event-card",onClick:()=>e.redirect(s.sport_type.stream_url)},{default:(0,l.w5)((()=>[(0,l.Wm)(R,{class:"flex justify-between items-center"},{default:(0,l.w5)((()=>[(0,l._)("span",m,[null!==s.team_gender?((0,l.wg)(),(0,l.iD)("span",u,(0,a.zw)(s.team_gender)+",",1)):(0,l.kq)("",!0),null!==s.team_type?((0,l.wg)(),(0,l.iD)("span",g,(0,a.zw)(s.team_type.name)+",",1)):(0,l.kq)("",!0),null!==s.sport_type?((0,l.wg)(),(0,l.iD)("span",p,(0,a.zw)(s.sport_type.name),1)):(0,l.kq)("",!0)])])),_:2},1024),(0,l.Wm)(O),(0,l.Wm)(R,{class:"q-py-lg"},{default:(0,l.w5)((()=>[(0,l._)("div",j,[null!==s.school1?((0,l.wg)(),(0,l.iD)("div",f,[null!==s.school1.logo?((0,l.wg)(),(0,l.j4)(B,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${s.school1.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,w)])),_:2},1032,["src"])):((0,l.wg)(),(0,l.j4)(B,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,l._)("div",b,(0,a.zw)(s.school1.name)+" ("+(0,a.zw)(s.school1.county.abbreviation)+") ",1)])):((0,l.wg)(),(0,l.iD)("div",y,k)),_,null!==s.school2?((0,l.wg)(),(0,l.iD)("div",x,[null!==s.school2.logo?((0,l.wg)(),(0,l.j4)(B,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${s.school2.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,C)])),_:2},1032,["src"])):((0,l.wg)(),(0,l.j4)(B,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,l._)("div",q,(0,a.zw)(s.school2.name)+" ("+(0,a.zw)(s.school2.county.abbreviation)+") ",1)])):((0,l.wg)(),(0,l.iD)("div",z,Z))]),null!==s.stadium?((0,l.wg)(),(0,l.iD)("div",W,[(0,l.Wm)(O),(0,l._)("div",D,[(0,l.Wm)(E,{name:"pin_drop"}),(0,l.Uk)("  "+(0,a.zw)(s.stadium),1)])])):(0,l.kq)("",!0)])),_:2},1024),(0,l.Wm)(O),(0,l.Wm)(R,{class:"flex items-center justify-between q-px-md bg-primary text-white"},{default:(0,l.w5)((()=>[(0,l._)("div",$,[(0,l.Wm)(E,{name:"calendar_month"}),(0,l._)("span",F,(0,a.zw)(e.scheduleDate(s.datetime)),1)]),(0,l._)("div",Q,[(0,l.Wm)(E,{name:"schedule"}),(0,l._)("span",L,(0,a.zw)(e.scheduleTime(s.datetime)),1)])])),_:2},1024)])),_:2},1032,["onClick"])),[[X]])])))),128))])])),_:1},8,["onLoad"])])):((0,l.wg)(),(0,l.iD)("div",T," No Upcoming Events ")),(0,l.Wm)(J,{showing:e.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"]),(0,l.Wm)(K,{show:e.filter.dialog,onHide:e.hideFilterDialog,onFilter:e.onFilter},null,8,["show","onHide","onFilter"])])),_:1})}t(702),t(4110),t(9829);var V=t(3878),M=t.n(V);const I=(0,l._)("div",{class:"text-h6 text-primary"},"Filter",-1);function R(e,s,t,a,o,i){const n=(0,l.up)("q-card-section"),r=(0,l.up)("q-select"),c=(0,l.up)("q-btn"),d=(0,l.up)("q-card-actions"),h=(0,l.up)("q-card"),m=(0,l.up)("q-dialog");return(0,l.wg)(),(0,l.iD)("div",null,[(0,l.Wm)(m,{modelValue:e.visible,"onUpdate:modelValue":s[1]||(s[1]=s=>e.visible=s),onHide:i.hide,position:"bottom"},{default:(0,l.w5)((()=>[(0,l.Wm)(h,{class:"card-bottom"},{default:(0,l.w5)((()=>[(0,l.Wm)(n,null,{default:(0,l.w5)((()=>[I])),_:1}),(0,l.Wm)(n,{class:"q-pt-none"},{default:(0,l.w5)((()=>[(0,l.Wm)(r,{"use-input":"","map-options":"","emit-value":"",label:"School","input-debounce":"0",modelValue:e.filter.school_id,"onUpdate:modelValue":s[0]||(s[0]=s=>e.filter.school_id=s),options:e.options.schools,onFilter:i.filterSchool},null,8,["modelValue","options","onFilter"])])),_:1}),(0,l.Wm)(d,{align:"right"},{default:(0,l.w5)((()=>[(0,l.Wm)(c,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:i.clearFilter},null,8,["onClick"]),(0,l.Wm)(c,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:i.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}const O={school_id:null},B={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...O},options:{schools:[]},master:{schools:[]}}},watch:{show:function(e){this.visible=e,e||this.hide()}},mounted:function(){this.getSchools()},methods:{clearFilter:function(){this.filter={...O},this.$emit("filter",this.filter),this.hide()},filterSchool:function(e,s){s(""!==e?()=>{const s=e.toLowerCase();this.options.schools=this.master.schools.filter((e=>e.label.toLowerCase().indexOf(s)>-1))}:()=>{this.options.schools=[...this.master.schools]})},getSchools:function(){const e=localStorage.getItem("masterdata_schools");if(null!==e){const s=JSON.parse(e);this.options.schools=[...s],this.master.schools=[...s]}},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var E=t(1639),H=t(2074),N=t(4458),A=t(3190),J=t(4861),Y=t(1821),K=t(4455),G=t(9984),X=t.n(G);const ee=(0,E.Z)(B,[["render",R]]),se=ee;X()(B,"components",{QDialog:H.Z,QCard:N.Z,QCardSection:A.Z,QSelect:J.Z,QCardActions:Y.Z,QBtn:K.Z});var te=t(7682);const le=(0,l.aZ)({name:"IndexPage",components:{MatchFilter:se},data:function(){return{filter:{dialog:!1,data:{}},loadingSchedule:!0,tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1}}},mounted:function(){this.getSchedule(),this.getSchools()},methods:{getSchools:function(){let e="school/list";e=te.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((e=>{const{data:s,message:t,status:l}=e.data;if(l){const e=[];s.list.map((s=>{e.push({label:s.name,value:s.id})})),window.localStorage.setItem("masterdata_schools",JSON.stringify(e))}}))},onFilter:async function(e){this.filter.data={...e},this.pagination.page=1,await this.getSchedule(),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(e,s){const t=this.pagination.page;t<this.pagination.total_page&&(this.pagination.page=parseInt(t)+1,await this.getSchedule()),s()},redirect:function(e){setTimeout((()=>{window.open(e)}),500)},refresh:async function(e){this.pagination.page=1,await this.getSchedule(),e()},scheduleDate:function(e){const s=M().utc(e).local().format("D MMMM Y");return s},scheduleTime:function(e){const s=M().utc(e).local().format("hh:mm"),t=M().tz.guess(),l=M().tz(t).zoneAbbr();return`${s} ${l}`},getSchedule:function(){return this.loadingSchedule=!0,new Promise(((e,s)=>{const t=this.pagination.page;let l="match-schedule/list";l=te.Z.generateURLParams(l,"page",t),l=te.Z.generateURLParams(l,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([e,s])=>{null!==s&&(this.has_filter=!0,l=te.Z.generateURLParams(l,e,s))})),this.$api.get(l).then((t=>{const{data:l,message:a,status:o}=t.data;o?(1===this.pagination.page?this.schedules=[...l.list]:this.schedules=this.schedules.concat(l.list),this.pagination={...this.pagination,page:l.pagination.page,total_page:l.pagination.total_page},e()):s()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var ae=t(9885),oe=t(990),ie=t(7817),ne=t(7661),re=t(699),ce=t(6870),de=t(2218),he=t(335),me=t(2857),ue=t(7501),ge=t(854),pe=t(1136);const je=(0,E.Z)(le,[["render",P],["__scopeId","data-v-191e13dc"]]),fe=je;X()(le,"components",{QPage:ae.Z,QBtn:K.Z,QBadge:oe.Z,QTabs:ie.Z,QTab:ne.Z,QPullToRefresh:re.Z,QInfiniteScroll:ce.Z,QCard:N.Z,QCardSection:A.Z,QSeparator:de.Z,QImg:he.Z,QIcon:me.Z,QSpinnerDots:ue.Z,QInnerLoading:ge.Z}),X()(le,"directives",{Ripple:pe.Z})},6700:(e,s,t)=>{var l={"./af":202,"./af.js":202,"./ar":6314,"./ar-dz":5666,"./ar-dz.js":5666,"./ar-kw":6591,"./ar-kw.js":6591,"./ar-ly":7900,"./ar-ly.js":7900,"./ar-ma":5667,"./ar-ma.js":5667,"./ar-sa":4092,"./ar-sa.js":4092,"./ar-tn":1379,"./ar-tn.js":1379,"./ar.js":6314,"./az":1699,"./az.js":1699,"./be":8988,"./be.js":8988,"./bg":7437,"./bg.js":7437,"./bm":7947,"./bm.js":7947,"./bn":2851,"./bn-bd":4905,"./bn-bd.js":4905,"./bn.js":2851,"./bo":7346,"./bo.js":7346,"./br":1711,"./br.js":1711,"./bs":3706,"./bs.js":3706,"./ca":112,"./ca.js":112,"./cs":6406,"./cs.js":6406,"./cv":1853,"./cv.js":1853,"./cy":9766,"./cy.js":9766,"./da":6836,"./da.js":6836,"./de":9320,"./de-at":4904,"./de-at.js":4904,"./de-ch":6710,"./de-ch.js":6710,"./de.js":9320,"./dv":3274,"./dv.js":3274,"./el":286,"./el.js":286,"./en-au":143,"./en-au.js":143,"./en-ca":237,"./en-ca.js":237,"./en-gb":2428,"./en-gb.js":2428,"./en-ie":3349,"./en-ie.js":3349,"./en-il":3764,"./en-il.js":3764,"./en-in":7809,"./en-in.js":7809,"./en-nz":9851,"./en-nz.js":9851,"./en-sg":5594,"./en-sg.js":5594,"./eo":4483,"./eo.js":4483,"./es":2184,"./es-do":5777,"./es-do.js":5777,"./es-mx":9356,"./es-mx.js":9356,"./es-us":8496,"./es-us.js":8496,"./es.js":2184,"./et":7578,"./et.js":7578,"./eu":2092,"./eu.js":2092,"./fa":5927,"./fa.js":5927,"./fi":171,"./fi.js":171,"./fil":2416,"./fil.js":2416,"./fo":9937,"./fo.js":9937,"./fr":5172,"./fr-ca":8249,"./fr-ca.js":8249,"./fr-ch":7541,"./fr-ch.js":7541,"./fr.js":5172,"./fy":7907,"./fy.js":7907,"./ga":6361,"./ga.js":6361,"./gd":2282,"./gd.js":2282,"./gl":2630,"./gl.js":2630,"./gom-deva":680,"./gom-deva.js":680,"./gom-latn":6220,"./gom-latn.js":6220,"./gu":6272,"./gu.js":6272,"./he":5540,"./he.js":5540,"./hi":6067,"./hi.js":6067,"./hr":9669,"./hr.js":9669,"./hu":3396,"./hu.js":3396,"./hy-am":6678,"./hy-am.js":6678,"./id":4812,"./id.js":4812,"./is":4193,"./is.js":4193,"./it":7863,"./it-ch":959,"./it-ch.js":959,"./it.js":7863,"./ja":1809,"./ja.js":1809,"./jv":8657,"./jv.js":8657,"./ka":3290,"./ka.js":3290,"./kk":8418,"./kk.js":8418,"./km":7687,"./km.js":7687,"./kn":1375,"./kn.js":1375,"./ko":2641,"./ko.js":2641,"./ku":3518,"./ku.js":3518,"./ky":5459,"./ky.js":5459,"./lb":1978,"./lb.js":1978,"./lo":6915,"./lo.js":6915,"./lt":8948,"./lt.js":8948,"./lv":2548,"./lv.js":2548,"./me":8608,"./me.js":8608,"./mi":333,"./mi.js":333,"./mk":6611,"./mk.js":6611,"./ml":999,"./ml.js":999,"./mn":4098,"./mn.js":4098,"./mr":6111,"./mr.js":6111,"./ms":3717,"./ms-my":265,"./ms-my.js":265,"./ms.js":3717,"./mt":8980,"./mt.js":8980,"./my":6895,"./my.js":6895,"./nb":5348,"./nb.js":5348,"./ne":1493,"./ne.js":1493,"./nl":4419,"./nl-be":5576,"./nl-be.js":5576,"./nl.js":4419,"./nn":6907,"./nn.js":6907,"./oc-lnc":2321,"./oc-lnc.js":2321,"./pa-in":9239,"./pa-in.js":9239,"./pl":7627,"./pl.js":7627,"./pt":5703,"./pt-br":1623,"./pt-br.js":1623,"./pt.js":5703,"./ro":2747,"./ro.js":2747,"./ru":4420,"./ru.js":4420,"./sd":2148,"./sd.js":2148,"./se":2461,"./se.js":2461,"./si":2783,"./si.js":2783,"./sk":3306,"./sk.js":3306,"./sl":341,"./sl.js":341,"./sq":2768,"./sq.js":2768,"./sr":2451,"./sr-cyrl":3371,"./sr-cyrl.js":3371,"./sr.js":2451,"./ss":8812,"./ss.js":8812,"./sv":3820,"./sv.js":3820,"./sw":3615,"./sw.js":3615,"./ta":2869,"./ta.js":2869,"./te":2044,"./te.js":2044,"./tet":5861,"./tet.js":5861,"./tg":6999,"./tg.js":6999,"./th":926,"./th.js":926,"./tk":7443,"./tk.js":7443,"./tl-ph":9786,"./tl-ph.js":9786,"./tlh":2812,"./tlh.js":2812,"./tr":6952,"./tr.js":6952,"./tzl":9573,"./tzl.js":9573,"./tzm":5990,"./tzm-latn":6961,"./tzm-latn.js":6961,"./tzm.js":5990,"./ug-cn":2610,"./ug-cn.js":2610,"./uk":9498,"./uk.js":9498,"./ur":3970,"./ur.js":3970,"./uz":9006,"./uz-latn":26,"./uz-latn.js":26,"./uz.js":9006,"./vi":9962,"./vi.js":9962,"./x-pseudo":8407,"./x-pseudo.js":8407,"./yo":1962,"./yo.js":1962,"./zh-cn":8909,"./zh-cn.js":8909,"./zh-hk":4014,"./zh-hk.js":4014,"./zh-mo":996,"./zh-mo.js":996,"./zh-tw":6327,"./zh-tw.js":6327};function a(e){var s=o(e);return t(s)}function o(e){if(!t.o(l,e)){var s=new Error("Cannot find module '"+e+"'");throw s.code="MODULE_NOT_FOUND",s}return l[e]}a.keys=function(){return Object.keys(l)},a.resolve=o,e.exports=a,a.id=6700}}]);