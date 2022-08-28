"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[715],{7682:(e,t,s)=>{s.d(t,{Z:()=>n});s(6727);var l=s(3701),a=s(9302);const{getScrollTarget:i,setVerticalScrollPosition:o}=l.ZP;(0,a.Z)();class n{static generateURLParams(e,t,s){return e.includes("?")?e+=`&${t}=${s}`:e+=`?${t}=${s}`,e}static scrollToElement(e,t=null){const s=i(e),l=null===t?e.offsetTop:t,a=500;o(s,l,a)}static loading(e,t=!0,s=null){t?e.$q.loading.show({message:null===s?"Loading ...":s}):e.$q.loading.hide()}}},5715:(e,t,s)=>{s.r(t),s.d(t,{default:()=>fe});var l=s(9835),a=s(6970);const i=e=>((0,l.dD)("data-v-7aff4d99"),e=e(),(0,l.Cn)(),e),o=i((()=>(0,l._)("div",{class:"text-white page-title flex flex-center title-container"},[(0,l._)("div",{class:"text-h4"}," schevents.com ")],-1))),n={class:"q-pt-xl page bg-accent"},c={key:0},r={class:"card-schedule-container"},d={class:"text-primary"},h={key:0},g={key:1,class:"capitalize"},m={key:2},u={class:"text-primary text-bold"},p={class:"vs-section q-mb-md"},f={key:0,class:"text-center q-mr-md"},w=["src"],_={class:"text-primary q-mt-md"},y={class:"text-bold"},b={class:"text-bold"},x={key:1,class:"q-ml-md flex flex-center"},v=i((()=>(0,l._)("div",{class:"text-red text-bold"},"Unknown School",-1))),q=[v],$=i((()=>(0,l._)("div",{class:"text-body1 text-grey-7 flex flex-center"}," VS ",-1))),k={key:2,class:"text-center q-ml-md"},S=["src"],Z={class:"text-primary q-mt-md"},D={class:"text-bold"},z={class:"text-bold"},Q={key:3,class:"q-ml-md flex flex-center"},W=i((()=>(0,l._)("div",{class:"text-red text-bold"},"Unknown School",-1))),T=[W],U={key:0},C={class:"flex items-center text-primary q-mt-md"},L={class:"flex flex-center"},P={class:"q-ml-sm"},j={class:"flex flex-center"},I={class:"q-ml-sm"},R={class:"flex flex-center q-py-md"},F={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function M(e,t,s,i,v,W){const M=(0,l.up)("q-tab"),V=(0,l.up)("q-tabs"),E=(0,l.up)("q-card-section"),O=(0,l.up)("q-separator"),N=(0,l.up)("q-img"),A=(0,l.up)("q-icon"),B=(0,l.up)("q-card"),H=(0,l.up)("q-spinner-dots"),J=(0,l.up)("q-infinite-scroll"),Y=(0,l.up)("q-inner-loading"),K=(0,l.up)("q-pull-to-refresh"),G=(0,l.up)("q-page"),X=(0,l.Q2)("ripple");return(0,l.wg)(),(0,l.j4)(G,null,{default:(0,l.w5)((()=>[o,(0,l.Wm)(V,{modelValue:e.tab,"onUpdate:modelValue":[t[0]||(t[0]=t=>e.tab=t),t[1]||(t[1]=()=>e.getSchedule(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,l.w5)((()=>[(0,l.Wm)(M,{name:"live",label:"Live"}),(0,l.Wm)(M,{name:"upcoming",label:"Upcoming"}),(0,l.Wm)(M,{name:"this-week",label:"This Week"}),(0,l.Wm)(M,{name:"today",label:"Today"})])),_:1},8,["modelValue"]),(0,l.Wm)(K,{onRefresh:e.refresh},{default:(0,l.w5)((()=>[(0,l._)("div",n,[e.schedules.length>0?((0,l.wg)(),(0,l.iD)("div",c,[(0,l.Wm)(J,{onLoad:e.loadMore},{loading:(0,l.w5)((()=>[(0,l._)("div",R,[(0,l.Wm)(H,{color:"accent",size:"40px"})])])),default:(0,l.w5)((()=>[(0,l._)("div",r,[((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(e.schedules,(t=>(0,l.wy)(((0,l.wg)(),(0,l.j4)(B,{key:t.id,class:"event-card",onClick:()=>e.redirect(t.id)},{default:(0,l.w5)((()=>[(0,l.Wm)(E,{class:"flex justify-between items-center"},{default:(0,l.w5)((()=>[(0,l._)("div",d,[null!==t.team_type?((0,l.wg)(),(0,l.iD)("span",h,(0,a.zw)(t.team_type.name)+" ",1)):(0,l.kq)("",!0),null!==t.team_gender?((0,l.wg)(),(0,l.iD)("span",g,(0,a.zw)(t.team_gender)+" ",1)):(0,l.kq)("",!0),null!==t.sport_type?((0,l.wg)(),(0,l.iD)("span",m,(0,a.zw)(t.sport_type.name),1)):(0,l.kq)("",!0)]),(0,l._)("div",u,[(0,l._)("span",null,(0,a.zw)(t.federation.abbreviation),1)])])),_:2},1024),(0,l.Wm)(O),(0,l.Wm)(E,{class:"q-py-lg"},{default:(0,l.w5)((()=>[(0,l._)("div",p,[null!==t.school1?((0,l.wg)(),(0,l.iD)("div",f,[null!==t.school1.logo?((0,l.wg)(),(0,l.j4)(N,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${t.school1.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,w)])),_:2},1032,["src"])):((0,l.wg)(),(0,l.j4)(N,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,l._)("div",_,[(0,l._)("div",y,(0,a.zw)(t.school1.name),1),(0,l._)("div",null,[(0,l.Uk)((0,a.zw)(t.school1.municipality.name)+",  ",1),(0,l._)("span",b,(0,a.zw)(t.school1.county.abbreviation),1)])])])):((0,l.wg)(),(0,l.iD)("div",x,q)),$,null!==t.school2?((0,l.wg)(),(0,l.iD)("div",k,[null!==t.school2.logo?((0,l.wg)(),(0,l.j4)(N,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${t.school2.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,S)])),_:2},1032,["src"])):((0,l.wg)(),(0,l.j4)(N,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,l._)("div",Z,[(0,l._)("div",D,(0,a.zw)(t.school1.name),1),(0,l._)("div",null,[(0,l.Uk)((0,a.zw)(t.school2.municipality.name)+",  ",1),(0,l._)("span",z,(0,a.zw)(t.school2.county.abbreviation),1)])])])):((0,l.wg)(),(0,l.iD)("div",Q,T))]),null!==t.stadium_id?((0,l.wg)(),(0,l.iD)("div",U,[(0,l.Wm)(O),(0,l._)("div",C,[(0,l.Wm)(A,{name:"pin_drop"}),(0,l.Uk)("  "+(0,a.zw)(t.stadium.name),1)])])):(0,l.kq)("",!0)])),_:2},1024),(0,l.Wm)(O),(0,l.Wm)(E,{class:"flex items-center justify-between q-px-md bg-secondary text-accent text-bold"},{default:(0,l.w5)((()=>[(0,l._)("div",L,[(0,l.Wm)(A,{name:"calendar_month"}),(0,l._)("span",P,(0,a.zw)(e.scheduleDate(t.datetime)),1)]),(0,l._)("div",j,[(0,l.Wm)(A,{name:"schedule"}),(0,l._)("span",I,(0,a.zw)(e.scheduleTime(t.datetime)),1)])])),_:2},1024)])),_:2},1032,["onClick"])),[[X]]))),128))])])),_:1},8,["onLoad"])])):((0,l.wg)(),(0,l.iD)("div",F," No Upcoming Events ")),(0,l.Wm)(Y,{showing:e.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"])])),_:1})}s(702),s(4110),s(9829);var V=s(3878),E=s.n(V),O=s(5457);const N={school_id:null},A={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...N},options:{schools:[]},master:{schools:[]}}},watch:{show:function(e){this.visible=e,e||this.hide()}},mounted:function(){this.getSchools()},methods:{clearFilter:function(){this.filter={...N},this.$emit("filter",this.filter),this.hide()},filterSchool:function(e,t){t(""!==e?()=>{const t=e.toLowerCase();this.options.schools=this.master.schools.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}:()=>{this.options.schools=[...this.master.schools]})},getSchools:function(){const e=localStorage.getItem("masterdata_schools");if(null!==e){const t=JSON.parse(e);this.options.schools=[...t],this.master.schools=[...t]}},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var B=s(1639),H=s(2074),J=s(4458),Y=s(3190),K=s(4861),G=s(1821),X=s(4455),ee=s(9984),te=s.n(ee);te()(A,"components",{QDialog:H.Z,QCard:J.Z,QCardSection:Y.Z,QSelect:K.Z,QCardActions:G.Z,QBtn:X.Z});var se=s(7682);const le=(0,l.aZ)({name:"IndexPage",data:function(){return{filter:{dialog:!1,data:{}},loadingSchedule:!0,tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1}}},mounted:function(){const e=this.$route.query.tab;"undefined"!==typeof e&&(this.tab=e,se.Z.scrollToElement(this.$refs.tab.$el)),this.getSchedule(),this.getSchools(),(0,O.Z)({title:"Home"})},methods:{getSchools:function(){let e="school/list";e=se.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((e=>{const{data:t,message:s,status:l}=e.data;if(l){const e=[];t.list.map((t=>{e.push({label:t.name,value:t.id})})),window.localStorage.setItem("masterdata_schools",JSON.stringify(e))}}))},onFilter:async function(e){this.filter.data={...e},await this.getSchedule(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(e,t){const s=this.pagination.page;s<this.pagination.total_page&&(this.pagination.page=parseInt(s)+1,await this.getSchedule()),t()},redirect:function(e){setTimeout((()=>{window.open(`${this.$host}/schedule/${e}`)}),500)},refresh:async function(e){await this.getSchedule(1),e()},scheduleDate:function(e){const t=E().utc(e).local().format("D MMMM Y");return t},scheduleTime:function(e){const t=E().utc(e).local().format("hh:mm"),s=E().tz.guess(),l=E().tz(s).zoneAbbr();return`${t} ${l}`},getSchedule:function(e=null){return null!==e&&(this.pagination.page=e),this.loadingSchedule=!0,new Promise(((e,t)=>{const s=this.pagination.page;let l="match-schedule/list";l=se.Z.generateURLParams(l,"page",s),l=se.Z.generateURLParams(l,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([e,t])=>{null!==t&&(this.has_filter=!0,l=se.Z.generateURLParams(l,e,t))})),this.$api.get(l).then((s=>{const{data:l,message:a,status:i}=s.data;i?(1===this.pagination.page?this.schedules=[...l.list]:this.schedules=this.schedules.concat(l.list),this.pagination={...this.pagination,page:l.pagination.page,total_page:l.pagination.total_page},e()):t()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var ae=s(9885),ie=s(7817),oe=s(7661),ne=s(699),ce=s(6870),re=s(2218),de=s(335),he=s(2857),ge=s(7501),me=s(854),ue=s(1136);const pe=(0,B.Z)(le,[["render",M],["__scopeId","data-v-7aff4d99"]]),fe=pe;te()(le,"components",{QPage:ae.Z,QTabs:ie.Z,QTab:oe.Z,QPullToRefresh:ne.Z,QInfiniteScroll:ce.Z,QCard:J.Z,QCardSection:Y.Z,QSeparator:re.Z,QImg:de.Z,QIcon:he.Z,QSpinnerDots:ge.Z,QInnerLoading:me.Z}),te()(le,"directives",{Ripple:ue.Z})}}]);