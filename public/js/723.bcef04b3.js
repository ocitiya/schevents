"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[723],{7682:(e,t,o)=>{o.d(t,{Z:()=>n});o(6727);var l=o(3701),i=o(9302);const{getScrollTarget:s,setVerticalScrollPosition:a}=l.ZP;(0,i.Z)();class n{static generateURLParams(e,t,o){return e.includes("?")?e+=`&${t}=${o}`:e+=`?${t}=${o}`,e}static scrollToElement(e,t=null){const o=s(e),l=null===t?e.offsetTop:t,i=500;a(o,l,i)}static loading(e,t=!0,o=null){t?e.$q.loading.show({message:null===o?"Loading ...":o}):e.$q.loading.hide()}}},723:(e,t,o)=>{o.r(t),o.d(t,{default:()=>$e});var l=o(9835),i=o(6970);const s=e=>((0,l.dD)("data-v-6494c8b6"),e=e(),(0,l.Cn)(),e),a=s((()=>(0,l._)("div",{class:"text-white page-title flex flex-center title-container"},[(0,l._)("div",{class:"text-h4"}," schevents.com ")],-1))),n={class:"text-right bg-secondary q-pr-md"},r={class:"q-pt-xl page bg-accent"},d={key:0},c={class:"card-schedule-container"},h={class:"text-primary"},u={key:0},m={key:1,class:"capitalize"},p={key:2},g={class:"text-primary text-bold"},f={class:"vs-section q-mb-md"},w={key:0,class:"text-center q-mr-md"},_=["src"],b={class:"text-primary q-mt-md"},y={class:"text-bold"},v={class:"text-bold"},x={key:1,class:"q-ml-md flex flex-center"},q=s((()=>(0,l._)("div",{class:"text-red text-bold"},"Unknown School",-1))),Z=[q],$=s((()=>(0,l._)("div",{class:"text-body1 text-grey-7 flex flex-center"}," VS ",-1))),S={key:2,class:"text-center q-ml-md"},k=["src"],W={class:"text-primary q-mt-md"},F={class:"text-bold"},C={class:"text-bold"},Q={key:3,class:"q-ml-md flex flex-center"},D=s((()=>(0,l._)("div",{class:"text-red text-bold"},"Unknown School",-1))),U=[D],L={key:0},z={class:"flex items-center text-primary q-mt-md"},V={class:"flex flex-center"},I={class:"q-ml-sm"},P={class:"flex flex-center"},T={class:"q-ml-sm"},R={class:"flex flex-center q-py-md"},j={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function M(e,t,o,s,q,D){const M=(0,l.up)("q-badge"),O=(0,l.up)("q-btn"),H=(0,l.up)("q-tab"),B=(0,l.up)("q-tabs"),E=(0,l.up)("q-card-section"),N=(0,l.up)("q-separator"),J=(0,l.up)("q-img"),A=(0,l.up)("q-icon"),Y=(0,l.up)("q-card"),K=(0,l.up)("q-spinner-dots"),G=(0,l.up)("q-infinite-scroll"),X=(0,l.up)("q-inner-loading"),ee=(0,l.up)("q-pull-to-refresh"),te=(0,l.up)("match-filter"),oe=(0,l.up)("q-page"),le=(0,l.Q2)("ripple");return(0,l.wg)(),(0,l.j4)(oe,null,{default:(0,l.w5)((()=>[a,(0,l._)("div",n,[(0,l.Wm)(O,{label:"filter",icon:"filter_alt",unelevated:"",color:"primary",onClick:e.showFilterDialog},{default:(0,l.w5)((()=>[e.has_filter?((0,l.wg)(),(0,l.j4)(M,{key:0,floating:"",color:"white",rounded:""})):(0,l.kq)("",!0)])),_:1},8,["onClick"])]),(0,l.Wm)(B,{modelValue:e.tab,"onUpdate:modelValue":[t[0]||(t[0]=t=>e.tab=t),t[1]||(t[1]=()=>e.getSchedule(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,l.w5)((()=>[(0,l.Wm)(H,{name:"live",label:"Live"}),(0,l.Wm)(H,{name:"upcoming",label:"Upcoming"}),(0,l.Wm)(H,{name:"this-week",label:"This Week"}),(0,l.Wm)(H,{name:"today",label:"Today"}),(0,l.Wm)(H,{name:"tomorrow",label:"Tomorrow"})])),_:1},8,["modelValue"]),(0,l.Wm)(ee,{onRefresh:e.refresh},{default:(0,l.w5)((()=>[(0,l._)("div",r,[e.schedules.length>0?((0,l.wg)(),(0,l.iD)("div",d,[(0,l.Wm)(G,{onLoad:e.loadMore},{loading:(0,l.w5)((()=>[(0,l._)("div",R,[(0,l.Wm)(K,{color:"accent",size:"40px"})])])),default:(0,l.w5)((()=>[(0,l._)("div",c,[((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(e.schedules,(t=>(0,l.wy)(((0,l.wg)(),(0,l.j4)(Y,{key:t.id,class:"event-card",onClick:()=>e.redirect(t.id)},{default:(0,l.w5)((()=>[(0,l.Wm)(E,{class:"flex justify-between items-center"},{default:(0,l.w5)((()=>[(0,l._)("div",h,[null!==t.team_type?((0,l.wg)(),(0,l.iD)("span",u,(0,i.zw)(t.team_type.name)+" ",1)):(0,l.kq)("",!0),null!==t.team_gender?((0,l.wg)(),(0,l.iD)("span",m,(0,i.zw)(t.team_gender)+" ",1)):(0,l.kq)("",!0),null!==t.sport_type?((0,l.wg)(),(0,l.iD)("span",p,(0,i.zw)(t.sport_type.name),1)):(0,l.kq)("",!0)]),(0,l._)("div",g,[(0,l._)("span",null,(0,i.zw)(t.federation.abbreviation),1)])])),_:2},1024),(0,l.Wm)(N),(0,l.Wm)(E,{class:"q-py-lg"},{default:(0,l.w5)((()=>[(0,l._)("div",f,[null!==t.school1?((0,l.wg)(),(0,l.iD)("div",w,[null!==t.school1.logo?((0,l.wg)(),(0,l.j4)(J,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${t.school1.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,_)])),_:2},1032,["src"])):((0,l.wg)(),(0,l.j4)(J,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,l._)("div",b,[(0,l._)("div",y,(0,i.zw)(t.school1.name),1),(0,l._)("div",null,[(0,l.Uk)((0,i.zw)(t.school1.municipality.name)+",  ",1),(0,l._)("span",v,(0,i.zw)(t.school1.county.abbreviation),1)])])])):((0,l.wg)(),(0,l.iD)("div",x,Z)),$,null!==t.school2?((0,l.wg)(),(0,l.iD)("div",S,[null!==t.school2.logo?((0,l.wg)(),(0,l.j4)(J,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${t.school2.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,k)])),_:2},1032,["src"])):((0,l.wg)(),(0,l.j4)(J,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,l._)("div",W,[(0,l._)("div",F,(0,i.zw)(t.school2.name),1),(0,l._)("div",null,[(0,l.Uk)((0,i.zw)(t.school2.municipality.name)+",  ",1),(0,l._)("span",C,(0,i.zw)(t.school2.county.abbreviation),1)])])])):((0,l.wg)(),(0,l.iD)("div",Q,U))]),null!==t.stadium_id?((0,l.wg)(),(0,l.iD)("div",L,[(0,l.Wm)(N),(0,l._)("div",z,[(0,l.Wm)(A,{name:"pin_drop"}),(0,l.Uk)("  "+(0,i.zw)(t.stadium.name),1)])])):(0,l.kq)("",!0)])),_:2},1024),(0,l.Wm)(N),(0,l.Wm)(E,{class:"flex items-center justify-between q-px-md bg-secondary text-accent text-bold"},{default:(0,l.w5)((()=>[(0,l._)("div",V,[(0,l.Wm)(A,{name:"calendar_month"}),(0,l._)("span",I,(0,i.zw)(e.scheduleDate(t.datetime)),1)]),(0,l._)("div",P,[(0,l.Wm)(A,{name:"schedule"}),(0,l._)("span",T,(0,i.zw)(e.scheduleTime(t.datetime)),1)])])),_:2},1024)])),_:2},1032,["onClick"])),[[le]]))),128))])])),_:1},8,["onLoad"])])):((0,l.wg)(),(0,l.iD)("div",j," No Upcoming Events ")),(0,l.Wm)(X,{showing:e.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"]),(0,l.Wm)(te,{show:e.filter.dialog,onHide:e.hideFilterDialog,onFilter:e.onFilter},null,8,["show","onHide","onFilter"])])),_:1})}o(702),o(4110),o(9829);var O=o(3878),H=o.n(O),B=o(5457);const E=(0,l._)("div",{class:"text-h6 text-primary"},"Filter",-1);function N(e,t,o,s,a,n){const r=(0,l.up)("q-card-section"),d=(0,l.up)("q-select"),c=(0,l.up)("q-img"),h=(0,l.up)("q-item-section"),u=(0,l.up)("q-item-label"),m=(0,l.up)("q-item"),p=(0,l.up)("q-btn"),g=(0,l.up)("q-card-actions"),f=(0,l.up)("q-card"),w=(0,l.up)("q-dialog");return(0,l.wg)(),(0,l.iD)("div",null,[(0,l.Wm)(w,{modelValue:e.visible,"onUpdate:modelValue":t[3]||(t[3]=t=>e.visible=t),onHide:n.hide,position:"bottom"},{default:(0,l.w5)((()=>[(0,l.Wm)(f,{class:"card-bottom"},{default:(0,l.w5)((()=>[(0,l.Wm)(r,null,{default:(0,l.w5)((()=>[E])),_:1}),(0,l.Wm)(r,{class:"q-pt-none"},{default:(0,l.w5)((()=>[(0,l.Wm)(d,{"use-input":"","map-options":"","emit-value":"",label:"Federation","input-debounce":"0",modelValue:e.filter.federation_id,"onUpdate:modelValue":[t[0]||(t[0]=t=>e.filter.federation_id=t),n.onFederationChange],options:e.options.federations,onFilter:n.filterFederation},null,8,["modelValue","options","onFilter","onUpdate:modelValue"]),(0,l.Wm)(d,{"use-input":"","map-options":"","emit-value":"",label:"Sport","input-debounce":"0",modelValue:e.filter.sport_id,"onUpdate:modelValue":t[1]||(t[1]=t=>e.filter.sport_id=t),options:e.options.sports,onFilter:n.filterSport},null,8,["modelValue","options","onFilter"]),(0,l.Wm)(d,{"use-input":"","map-options":"","emit-value":"",label:"School","input-debounce":"0",modelValue:e.filter.school_id,"onUpdate:modelValue":t[2]||(t[2]=t=>e.filter.school_id=t),options:e.options.schools,onFilter:n.filterSchool},{option:(0,l.w5)((e=>[(0,l.Wm)(m,(0,i.vs)((0,l.F4)(e.itemProps)),{default:(0,l.w5)((()=>[(0,l.Wm)(h,{avatar:""},{default:(0,l.w5)((()=>[(0,l.Wm)(c,{src:e.opt.icon},null,8,["src"])])),_:2},1024),(0,l.Wm)(h,null,{default:(0,l.w5)((()=>[(0,l.Wm)(u,null,{default:(0,l.w5)((()=>[(0,l.Uk)((0,i.zw)(e.opt.label),1)])),_:2},1024)])),_:2},1024)])),_:2},1040)])),_:1},8,["modelValue","options","onFilter"])])),_:1}),(0,l.Wm)(g,{align:"right"},{default:(0,l.w5)((()=>[(0,l.Wm)(p,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:n.clearFilter},null,8,["onClick"]),(0,l.Wm)(p,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:n.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}var J=o(7682);const A={school_id:null,federation_id:null,sport_id:null},Y={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...A},options:{schools:[],federations:[],sports:[]},master:{schools:[],federations:[],sports:[]}}},watch:{show:function(e){this.visible=e,e||this.hide()}},mounted:function(){this.getSchools(),this.getFederations(),this.getSports()},methods:{onFederationChange:function(e){this.filter.school_id=null,this.filter.sport_id=null,this.getSchools(e),this.getSports(e)},clearFilter:function(){this.filter={...A},this.$emit("filter",this.filter),this.hide()},filterSchool:function(e,t){t((()=>{const t=e.toLowerCase();this.options.schools=this.master.schools.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},filterFederation:function(e,t){t((()=>{const t=e.toLowerCase();this.options.federations=this.master.federations.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},filterSport:function(e,t){t((()=>{const t=e.toLowerCase();this.options.sports=this.master.sports.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},getSchools:function(e=null){J.Z.loading(this),this.options.schools=[],this.master.schools=[],window.localStorage.removeItem("masterdata_schools");let t="school/list";t=J.Z.generateURLParams(t,"showall",!0),null!==e&&(t=J.Z.generateURLParams(t,"federation_id",e)),this.$api.get(t).then((e=>{const{data:t,message:o,status:l}=e.data;if(l){const e=[];t.list.map((t=>{e.push({label:t.name,value:t.id,icon:`${this.$host}/storage/school/logo/${t.logo}`})})),this.options.schools=[...e],this.master.schools=[...e],window.localStorage.setItem("masterdata_schools",JSON.stringify(e))}})).finally((()=>{this.filter.school_id="undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,J.Z.loading(this,!1)}))},getSports:function(e=null){this.options.sports=[],this.master.sports=[],window.localStorage.removeItem("masterdata_sports"),J.Z.loading(this);let t="sport-type/list";t=J.Z.generateURLParams(t,"showall",!0),null!==e&&(t=J.Z.generateURLParams(t,"federation_id",e)),this.$api.get(t).then((e=>{const{data:t,message:o,status:l}=e.data;if(l){const e=[];t.list.map((t=>{null!==t.sport?e.push({label:`${t.federation.abbreviation} - ${t.sport.name}`,value:t.id}):e.push({label:`${t.federation.abbreviation} - ${t.name}`,value:t.id})})),this.options.sports=[...e],this.master.sports=[...e],window.localStorage.setItem("masterdata_sports",JSON.stringify(e))}})).finally((()=>{J.Z.loading(this,!1)}))},getFederations:function(){this.options.federations=[],this.master.federations=[],window.localStorage.removeItem("masterdata_federations"),J.Z.loading(this);let e="federation/list";e=J.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((e=>{const{data:t,message:o,status:l}=e.data;if(l){const e=[];t.list.map((t=>{e.push({label:t.abbreviation,value:t.id})})),this.options.federations=[...e],this.master.federations=[...e],window.localStorage.setItem("masterdata_federations",JSON.stringify(e))}})).finally((()=>{J.Z.loading(this,!1)}))},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var K=o(1639),G=o(2074),X=o(4458),ee=o(3190),te=o(8003),oe=o(490),le=o(1233),ie=o(335),se=o(3115),ae=o(1821),ne=o(4455),re=o(9984),de=o.n(re);const ce=(0,K.Z)(Y,[["render",N]]),he=ce;de()(Y,"components",{QDialog:G.Z,QCard:X.Z,QCardSection:ee.Z,QSelect:te.Z,QItem:oe.Z,QItemSection:le.Z,QImg:ie.Z,QItemLabel:se.Z,QCardActions:ae.Z,QBtn:ne.Z});const ue=(0,l.aZ)({name:"IndexPage",components:{MatchFilter:he},data:function(){return{filter:{dialog:!1,data:{school_id:"undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,federation_id:null,sport_id:null}},loadingSchedule:!0,tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1}}},mounted:function(){console.log(this.filter.data.school_id);const e=this.$route.query.tab;"undefined"!==typeof e&&(this.tab=e,J.Z.scrollToElement(this.$refs.tab.$el)),null!==this.filter.data.school_id?(this.filter.data.school_id=this.filter.data.school_id,this.onFilter(this.filter.data)):this.getSchedule(),(0,B.Z)({title:"Home"})},methods:{onFilter:async function(e){this.filter.data={...e},await this.getSchedule(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(e,t){const o=this.pagination.page;o<this.pagination.total_page&&(this.pagination.page=parseInt(o)+1,await this.getSchedule()),t()},redirect:function(e){setTimeout((()=>{window.open(`${this.$host}/schedule/${e}`)}),500)},refresh:async function(e){await this.getSchedule(1),e()},scheduleDate:function(e){const t=H().utc(e).local().format("D MMMM Y");return t},scheduleTime:function(e){const t=H().utc(e).local().format("hh:mm"),o=H().tz.guess(),l=H().tz(o).zoneAbbr();return`${t} ${l}`},getSchedule:function(e=null){return null!==e&&(this.pagination.page=e),this.loadingSchedule=!0,new Promise(((e,t)=>{const o=this.pagination.page;let l="match-schedule/list";l=J.Z.generateURLParams(l,"page",o),l=J.Z.generateURLParams(l,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([e,t])=>{null!==t&&(this.has_filter=!0,l=J.Z.generateURLParams(l,e,t))})),this.$api.get(l).then((o=>{const{data:l,message:i,status:s}=o.data;s?(1===this.pagination.page?this.schedules=[...l.list]:this.schedules=this.schedules.concat(l.list),this.pagination={...this.pagination,page:l.pagination.page,total_page:l.pagination.total_page},e()):t()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var me=o(9885),pe=o(990),ge=o(7817),fe=o(7661),we=o(699),_e=o(6870),be=o(2218),ye=o(2857),ve=o(7501),xe=o(854),qe=o(1136);const Ze=(0,K.Z)(ue,[["render",M],["__scopeId","data-v-6494c8b6"]]),$e=Ze;de()(ue,"components",{QPage:me.Z,QBtn:ne.Z,QBadge:pe.Z,QTabs:ge.Z,QTab:fe.Z,QPullToRefresh:we.Z,QInfiniteScroll:_e.Z,QCard:X.Z,QCardSection:ee.Z,QSeparator:be.Z,QImg:ie.Z,QIcon:ye.Z,QSpinnerDots:ve.Z,QInnerLoading:xe.Z}),de()(ue,"directives",{Ripple:qe.Z})}}]);