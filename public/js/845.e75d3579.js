"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[845],{7682:(e,t,l)=>{l.d(t,{Z:()=>n});l(6727);var o=l(3701),i=l(9302);const{getScrollTarget:s,setVerticalScrollPosition:a}=o.ZP;(0,i.Z)();class n{static generateURLParams(e,t,l){return e.includes("?")?e+=`&${t}=${l}`:e+=`?${t}=${l}`,e}static scrollToElement(e,t=null){const l=s(e),o=null===t?e.offsetTop:t,i=500;a(l,o,i)}static loading(e,t=!0,l=null){t?e.$q.loading.show({message:null===l?"Loading ...":l}):e.$q.loading.hide()}}},5845:(e,t,l)=>{l.r(t),l.d(t,{default:()=>Le});var o=l(9835),i=l(6970);const s=e=>((0,o.dD)("data-v-782159e8"),e=e(),(0,o.Cn)(),e),a={class:"text-right bg-secondary q-pr-md q-pt-lg"},n={class:"q-pt-xl page bg-accent"},r={key:0},c={class:"card-schedule-container"},d={class:"text-primary"},h={key:0},u={key:1,class:"capitalize"},m={key:2},p={key:3},g={class:"text-primary text-bold"},f={key:0},w={key:1},_={class:"vs-section q-mb-md"},b={key:0,class:"text-center q-mr-md"},y=["src"],v={class:"text-primary q-mt-md"},q={class:"text-bold"},k={key:0},x={key:0,class:"text-bold"},Z={key:1,class:"q-ml-md flex flex-center"},$=s((()=>(0,o._)("div",{class:"text-red text-bold"},"Unknown School",-1))),S=[$],W=s((()=>(0,o._)("div",{class:"text-body1 text-grey-7 flex flex-center"}," VS ",-1))),C={key:2,class:"text-center q-ml-md"},D=["src"],Q={class:"text-primary q-mt-md"},F={class:"text-bold"},U={key:0},V={key:0,class:"text-bold"},z={key:3,class:"q-ml-md flex flex-center"},L=s((()=>(0,o._)("div",{class:"text-red text-bold"},"Unknown School",-1))),P=[L],I={key:0},T={class:"flex items-center text-primary q-mt-md"},R={class:"flex flex-center"},j={class:"q-ml-sm"},M={class:"flex flex-center"},O={class:"q-ml-sm"},B={class:"flex flex-center q-py-md"},H={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function E(e,t,l,s,$,L){const E=(0,o.up)("q-badge"),N=(0,o.up)("q-btn"),J=(0,o.up)("q-tab"),A=(0,o.up)("q-tabs"),Y=(0,o.up)("q-card-section"),K=(0,o.up)("q-separator"),G=(0,o.up)("q-img"),X=(0,o.up)("q-icon"),ee=(0,o.up)("q-card"),te=(0,o.up)("q-spinner-dots"),le=(0,o.up)("q-infinite-scroll"),oe=(0,o.up)("q-inner-loading"),ie=(0,o.up)("q-pull-to-refresh"),se=(0,o.up)("match-filter"),ae=(0,o.up)("q-page"),ne=(0,o.Q2)("ripple");return(0,o.wg)(),(0,o.j4)(ae,null,{default:(0,o.w5)((()=>[(0,o._)("div",a,[(0,o.Wm)(N,{label:"filter",icon:"filter_alt",unelevated:"",color:"primary",onClick:e.showFilterDialog},{default:(0,o.w5)((()=>[e.has_filter?((0,o.wg)(),(0,o.j4)(E,{key:0,floating:"",color:"white",rounded:""})):(0,o.kq)("",!0)])),_:1},8,["onClick"])]),(0,o.Wm)(A,{modelValue:e.tab,"onUpdate:modelValue":[t[0]||(t[0]=t=>e.tab=t),t[1]||(t[1]=()=>e.getSchedule(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,o.w5)((()=>[(0,o.Wm)(J,{name:"live",label:"Live"}),(0,o.Wm)(J,{name:"upcoming",label:"Upcoming"}),(0,o.Wm)(J,{name:"this-week",label:"This Week"}),(0,o.Wm)(J,{name:"today",label:"Today"}),(0,o.Wm)(J,{name:"tomorrow",label:"Tomorrow"})])),_:1},8,["modelValue"]),(0,o.Wm)(ie,{onRefresh:e.refresh},{default:(0,o.w5)((()=>[(0,o._)("div",n,[e.schedules.length>0?((0,o.wg)(),(0,o.iD)("div",r,[(0,o.Wm)(le,{onLoad:e.loadMore},{loading:(0,o.w5)((()=>[(0,o._)("div",B,[(0,o.Wm)(te,{color:"accent",size:"40px"})])])),default:(0,o.w5)((()=>[(0,o._)("div",c,[((0,o.wg)(!0),(0,o.iD)(o.HY,null,(0,o.Ko)(e.schedules,(t=>(0,o.wy)(((0,o.wg)(),(0,o.j4)(ee,{key:t.id,class:"event-card",onClick:()=>e.redirect(t.id)},{default:(0,o.w5)((()=>[(0,o.Wm)(Y,{class:"flex justify-between items-center"},{default:(0,o.w5)((()=>[(0,o._)("div",d,[null!==t.team_type?((0,o.wg)(),(0,o.iD)("span",h,(0,i.zw)(t.team_type.name)+" ",1)):(0,o.kq)("",!0),null!==t.team_gender?((0,o.wg)(),(0,o.iD)("span",u,(0,i.zw)(t.team_gender)+" ",1)):(0,o.kq)("",!0),null!==t.sport?((0,o.wg)(),(0,o.iD)("span",m,(0,i.zw)(t.sport.name),1)):null!==t.sport_type?((0,o.wg)(),(0,o.iD)("span",p,(0,i.zw)(t.sport_type.name),1)):(0,o.kq)("",!0)]),(0,o._)("div",g,[null!==t.championship?((0,o.wg)(),(0,o.iD)("span",f,(0,i.zw)(t.championship.abbreviation),1)):null!==t.federation?((0,o.wg)(),(0,o.iD)("span",w,(0,i.zw)(t.federation.abbreviation),1)):(0,o.kq)("",!0)])])),_:2},1024),(0,o.Wm)(K),(0,o.Wm)(Y,{class:"q-py-lg"},{default:(0,o.w5)((()=>[(0,o._)("div",_,[null!==t.school1?((0,o.wg)(),(0,o.iD)("div",b,[null!==t.school1.logo?((0,o.wg)(),(0,o.j4)(G,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${t.school1.logo}`,ratio:1},{error:(0,o.w5)((()=>[(0,o._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,y)])),_:2},1032,["src"])):((0,o.wg)(),(0,o.j4)(G,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,o._)("div",v,[(0,o._)("div",q,(0,i.zw)(t.school1.name),1),null!==t.school1.municipality?((0,o.wg)(),(0,o.iD)("div",k,[(0,o.Uk)((0,i.zw)(t.school1.municipality.name)+" ",1),null!==t.school1.county?((0,o.wg)(),(0,o.iD)("span",x," , "+(0,i.zw)(t.school1.county.abbreviation),1)):(0,o.kq)("",!0)])):(0,o.kq)("",!0)])])):((0,o.wg)(),(0,o.iD)("div",Z,S)),W,null!==t.school2?((0,o.wg)(),(0,o.iD)("div",C,[null!==t.school2.logo?((0,o.wg)(),(0,o.j4)(G,{key:0,class:"logo",src:`${e.$host}/storage/school/logo/${t.school2.logo}`,ratio:1},{error:(0,o.w5)((()=>[(0,o._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,D)])),_:2},1032,["src"])):((0,o.wg)(),(0,o.j4)(G,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,o._)("div",Q,[(0,o._)("div",F,(0,i.zw)(t.school2.name),1),null!==t.school2.municipality?((0,o.wg)(),(0,o.iD)("div",U,[(0,o.Uk)((0,i.zw)(t.school2.municipality.name)+" ",1),null!==t.school2.county?((0,o.wg)(),(0,o.iD)("span",V," , "+(0,i.zw)(t.school2.county.abbreviation),1)):(0,o.kq)("",!0)])):(0,o.kq)("",!0)])])):((0,o.wg)(),(0,o.iD)("div",z,P))]),null!==t.stadium_id?((0,o.wg)(),(0,o.iD)("div",I,[(0,o.Wm)(K),(0,o._)("div",T,[(0,o.Wm)(X,{name:"pin_drop"}),(0,o.Uk)("  "+(0,i.zw)(t.stadium.name),1)])])):(0,o.kq)("",!0)])),_:2},1024),(0,o.Wm)(K),(0,o.Wm)(Y,{class:"flex items-center justify-between q-px-md bg-secondary text-accent text-bold"},{default:(0,o.w5)((()=>[(0,o._)("div",R,[(0,o.Wm)(X,{name:"calendar_month"}),(0,o._)("span",j,(0,i.zw)(e.scheduleDate(t.datetime)),1)]),(0,o._)("div",M,[(0,o.Wm)(X,{name:"schedule"}),(0,o._)("span",O,(0,i.zw)(e.scheduleTime(t.datetime)),1)])])),_:2},1024)])),_:2},1032,["onClick"])),[[ne]]))),128))])])),_:1},8,["onLoad"])])):((0,o.wg)(),(0,o.iD)("div",H," No Upcoming Events ")),(0,o.Wm)(oe,{showing:e.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"]),(0,o.Wm)(se,{show:e.filter.dialog,onHide:e.hideFilterDialog,onFilter:e.onFilter},null,8,["show","onHide","onFilter"])])),_:1})}l(702),l(4110),l(9829);var N=l(3878),J=l.n(N),A=l(5457);const Y=(0,o._)("div",{class:"text-h6 text-primary"},"Filter",-1),K={class:"row items-center justify-end"};function G(e,t,l,s,a,n){const r=(0,o.up)("q-card-section"),c=(0,o.up)("q-btn"),d=(0,o.up)("q-date"),h=(0,o.up)("q-popup-proxy"),u=(0,o.up)("q-icon"),m=(0,o.up)("q-input"),p=(0,o.up)("q-select"),g=(0,o.up)("q-img"),f=(0,o.up)("q-item-section"),w=(0,o.up)("q-item-label"),_=(0,o.up)("q-item"),b=(0,o.up)("q-card-actions"),y=(0,o.up)("q-card"),v=(0,o.up)("q-dialog"),q=(0,o.Q2)("close-popup");return(0,o.wg)(),(0,o.iD)("div",null,[(0,o.Wm)(v,{modelValue:e.visible,"onUpdate:modelValue":t[5]||(t[5]=t=>e.visible=t),onHide:n.hide,position:"bottom"},{default:(0,o.w5)((()=>[(0,o.Wm)(y,{class:"card-bottom"},{default:(0,o.w5)((()=>[(0,o.Wm)(r,null,{default:(0,o.w5)((()=>[Y])),_:1}),(0,o.Wm)(r,{class:"q-pt-none"},{default:(0,o.w5)((()=>[(0,o.Wm)(m,{modelValue:e.filter.date,"onUpdate:modelValue":t[1]||(t[1]=t=>e.filter.date=t),mask:"date",readonly:"",label:"Date"},{append:(0,o.w5)((()=>[(0,o.Wm)(u,{name:"event",class:"cursor-pointer"},{default:(0,o.w5)((()=>[(0,o.Wm)(h,{cover:"","transition-show":"scale","transition-hide":"scale"},{default:(0,o.w5)((()=>[(0,o.Wm)(d,{modelValue:e.filter.date,"onUpdate:modelValue":t[0]||(t[0]=t=>e.filter.date=t)},{default:(0,o.w5)((()=>[(0,o._)("div",K,[(0,o.wy)((0,o.Wm)(c,{label:"Close",color:"primary",flat:""},null,512),[[q]])])])),_:1},8,["modelValue"])])),_:1})])),_:1})])),_:1},8,["modelValue"]),(0,o.Wm)(p,{"use-input":"","map-options":"","emit-value":"",label:"Champions","input-debounce":"0",modelValue:e.filter.champion_id,"onUpdate:modelValue":t[2]||(t[2]=t=>e.filter.champion_id=t),options:e.options.champions,onFilter:n.filterChampions},null,8,["modelValue","options","onFilter"]),(0,o.Wm)(p,{"use-input":"","map-options":"","emit-value":"",label:"Sport","input-debounce":"0",modelValue:e.filter.sport_id,"onUpdate:modelValue":t[3]||(t[3]=t=>e.filter.sport_id=t),options:e.options.sports,onFilter:n.filterSport},null,8,["modelValue","options","onFilter"]),(0,o.Wm)(p,{"use-input":"","map-options":"","emit-value":"",label:"School","input-debounce":"0",modelValue:e.filter.school_id,"onUpdate:modelValue":t[4]||(t[4]=t=>e.filter.school_id=t),options:e.options.schools,onFilter:n.filterSchool},{option:(0,o.w5)((e=>[(0,o.Wm)(_,(0,i.vs)((0,o.F4)(e.itemProps)),{default:(0,o.w5)((()=>[(0,o.Wm)(f,{avatar:""},{default:(0,o.w5)((()=>[(0,o.Wm)(g,{src:e.opt.icon},null,8,["src"])])),_:2},1024),(0,o.Wm)(f,null,{default:(0,o.w5)((()=>[(0,o.Wm)(w,null,{default:(0,o.w5)((()=>[(0,o.Uk)((0,i.zw)(e.opt.label),1)])),_:2},1024)])),_:2},1024)])),_:2},1040)])),_:1},8,["modelValue","options","onFilter"])])),_:1}),(0,o.Wm)(b,{align:"right"},{default:(0,o.w5)((()=>[(0,o.Wm)(c,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:n.clearFilter},null,8,["onClick"]),(0,o.Wm)(c,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:n.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}var X=l(7682);const ee={school_id:null,champion_id:null,sport_id:null,date:null},te={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...ee},options:{schools:[],champions:[],sports:[]},master:{schools:[],champions:[],sports:[]}}},watch:{show:function(e){this.visible=e,e||this.hide()}},mounted:function(){this.getSchools(),this.getChampions(),this.getSports()},methods:{clearFilter:function(){this.filter={...ee},this.$emit("filter",this.filter),this.hide()},filterSchool:function(e,t){t((()=>{const t=e.toLowerCase();this.options.schools=this.master.schools.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},filterChampions:function(e,t){t((()=>{const t=e.toLowerCase();this.options.champions=this.master.champions.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},filterSport:function(e,t){t((()=>{const t=e.toLowerCase();this.options.sports=this.master.sports.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},getSchools:function(e=null){X.Z.loading(this),this.options.schools=[],this.master.schools=[],window.localStorage.removeItem("masterdata_schools");let t="school/list";t=X.Z.generateURLParams(t,"showall",!0),this.$api.get(t).then((e=>{const{data:t,message:l,status:o}=e.data;if(o){const e=[];t.list.map((t=>{e.push({label:t.name,value:t.id,icon:`${this.$host}/storage/school/logo/${t.logo}`})})),this.options.schools=[...e],this.master.schools=[...e],window.localStorage.setItem("masterdata_schools",JSON.stringify(e))}})).finally((()=>{this.filter.school_id="undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,X.Z.loading(this,!1)}))},getSports:function(e=null){this.options.sports=[],this.master.sports=[],window.localStorage.removeItem("masterdata_sports"),X.Z.loading(this);let t="sport/list";t=X.Z.generateURLParams(t,"showall",!0),null!==e&&(t=X.Z.generateURLParams(t,"champion_id",e)),this.$api.get(t).then((e=>{const{data:t,message:l,status:o}=e.data;if(o){const e=[];t.list.map((t=>{e.push({label:t.name,value:t.id})})),this.options.sports=[...e],this.master.sports=[...e],window.localStorage.setItem("masterdata_sports",JSON.stringify(e))}})).finally((()=>{X.Z.loading(this,!1)}))},getChampions:function(){this.options.champions=[],this.master.champions=[],window.localStorage.removeItem("masterdata_champions"),X.Z.loading(this);let e="championship/list";e=X.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((e=>{const{data:t,message:l,status:o}=e.data;if(o){const e=[];t.list.map((t=>{e.push({label:t.abbreviation,value:t.id})})),this.options.champions=[...e],this.master.champions=[...e],window.localStorage.setItem("masterdata_champions",JSON.stringify(e))}})).finally((()=>{X.Z.loading(this,!1)}))},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var le=l(1639),oe=l(2074),ie=l(4458),se=l(3190),ae=l(1852),ne=l(2857),re=l(2765),ce=l(7088),de=l(4455),he=l(8379),ue=l(490),me=l(1233),pe=l(335),ge=l(3115),fe=l(1821),we=l(2146),_e=l(9984),be=l.n(_e);const ye=(0,le.Z)(te,[["render",G]]),ve=ye;be()(te,"components",{QDialog:oe.Z,QCard:ie.Z,QCardSection:se.Z,QInput:ae.Z,QIcon:ne.Z,QPopupProxy:re.Z,QDate:ce.Z,QBtn:de.Z,QSelect:he.Z,QItem:ue.Z,QItemSection:me.Z,QImg:pe.Z,QItemLabel:ge.Z,QCardActions:fe.Z}),be()(te,"directives",{ClosePopup:we.Z});const qe=(0,o.aZ)({name:"IndexPage",components:{MatchFilter:ve},data:function(){return{slide:0,banners:[],filter:{dialog:!1,data:{school_id:"undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,champion_id:null,sport_id:null,date:null}},loadingSchedule:!0,tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1}}},mounted:function(){this.getBanners();const e=this.$route.query.tab;"undefined"!==typeof e&&(this.tab=e,X.Z.scrollToElement(this.$refs.tab.$el)),null!==this.filter.data.school_id?(this.filter.data.school_id=this.filter.data.school_id,this.onFilter(this.filter.data)):this.getSchedule(),(0,A.Z)({title:"Home"})},methods:{getBanners:function(){return new Promise(((e,t)=>{let l="banner/list?showall=true";this.$api.get(l).then((l=>{const{data:o,message:i,status:s}=l.data;s?(this.banners=[...o.list],e()):t()}))}))},onFilter:async function(e){this.filter.data={...e},null!==this.filter.data.date&&(this.tab=null),await this.getSchedule(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(e,t){const l=this.pagination.page;l<this.pagination.total_page&&(this.pagination.page=parseInt(l)+1,await this.getSchedule()),t()},redirect:function(e){setTimeout((()=>{window.open(`${this.$host}/schedule/${e}`)}),300)},refresh:async function(e){await this.getSchedule(1),e()},scheduleDate:function(e){const t=J().utc(e).local().format("D MMMM Y");return t},scheduleTime:function(e){const t=J().utc(e).local().format("hh:mm"),l=J().tz.guess(),o=J().tz(l).zoneAbbr();return`${t} ${o}`},getSchedule:function(e=null){return null!==e&&(this.pagination.page=e),this.loadingSchedule=!0,new Promise(((e,t)=>{const l=this.pagination.page;let o="match-schedule/list";o=X.Z.generateURLParams(o,"page",l),o=X.Z.generateURLParams(o,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([e,t])=>{null!==t&&(this.has_filter=!0,o=X.Z.generateURLParams(o,e,t))})),this.$api.get(o).then((l=>{const{data:o,message:i,status:s}=l.data;s?(1===this.pagination.page?this.schedules=[...o.list]:this.schedules=this.schedules.concat(o.list),this.pagination={...this.pagination,page:o.pagination.page,total_page:o.pagination.total_page},e()):t()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var ke=l(9885),xe=l(960),Ze=l(1694),$e=l(990),Se=l(7817),We=l(7661),Ce=l(699),De=l(6870),Qe=l(2218),Fe=l(7501),Ue=l(854),Ve=l(1136);const ze=(0,le.Z)(qe,[["render",E],["__scopeId","data-v-782159e8"]]),Le=ze;be()(qe,"components",{QPage:ke.Z,QCarousel:xe.Z,QCarouselSlide:Ze.Z,QImg:pe.Z,QBtn:de.Z,QBadge:$e.Z,QTabs:Se.Z,QTab:We.Z,QPullToRefresh:Ce.Z,QInfiniteScroll:De.Z,QCard:ie.Z,QCardSection:se.Z,QSeparator:Qe.Z,QIcon:ne.Z,QSpinnerDots:Fe.Z,QInnerLoading:Ue.Z}),be()(qe,"directives",{Ripple:Ve.Z})}}]);