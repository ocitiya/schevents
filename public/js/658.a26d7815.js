"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[658],{7682:(t,e,i)=>{i.d(e,{Z:()=>n});i(6727);var o=i(3701),a=i(9302);const{getScrollTarget:l,setVerticalScrollPosition:s}=o.ZP;(0,a.Z)();class n{static generateURLParams(t,e,i){return t.includes("?")?t+=`&${e}=${i}`:t+=`?${e}=${i}`,t}static scrollToElement(t,e=null){const i=l(t),o=null===e?t.offsetTop:e,a=500;s(i,o,a)}static loading(t,e=!0,i=null){e?t.$q.loading.show({message:null===i?"Loading ...":i}):t.$q.loading.hide()}}},3562:(t,e,i)=>{i.d(e,{Z:()=>V});var o=i(9835),a=i(6970);const l=(0,o._)("div",{class:"text-h6 text-primary"},"Filter",-1),s={class:"row items-center justify-end"};function n(t,e,i,n,r,c){const d=(0,o.up)("q-card-section"),h=(0,o.up)("q-btn"),p=(0,o.up)("q-date"),u=(0,o.up)("q-popup-proxy"),m=(0,o.up)("q-icon"),g=(0,o.up)("q-input"),f=(0,o.up)("q-select"),_=(0,o.up)("q-img"),w=(0,o.up)("q-item-section"),b=(0,o.up)("q-item-label"),v=(0,o.up)("q-item"),y=(0,o.up)("q-card-actions"),Z=(0,o.up)("q-card"),x=(0,o.up)("q-dialog"),q=(0,o.Q2)("close-popup");return(0,o.wg)(),(0,o.iD)("div",null,[(0,o.Wm)(x,{modelValue:t.visible,"onUpdate:modelValue":e[5]||(e[5]=e=>t.visible=e),onHide:c.hide,position:"bottom"},{default:(0,o.w5)((()=>[(0,o.Wm)(Z,{class:"card-bottom"},{default:(0,o.w5)((()=>[(0,o.Wm)(d,null,{default:(0,o.w5)((()=>[l])),_:1}),(0,o.Wm)(d,{class:"q-pt-none"},{default:(0,o.w5)((()=>[(0,o.Wm)(g,{modelValue:t.filter.date,"onUpdate:modelValue":e[1]||(e[1]=e=>t.filter.date=e),mask:"date",readonly:"",label:"Date"},{append:(0,o.w5)((()=>[(0,o.Wm)(m,{name:"event",class:"cursor-pointer"},{default:(0,o.w5)((()=>[(0,o.Wm)(u,{cover:"","transition-show":"scale","transition-hide":"scale"},{default:(0,o.w5)((()=>[(0,o.Wm)(p,{modelValue:t.filter.date,"onUpdate:modelValue":e[0]||(e[0]=e=>t.filter.date=e)},{default:(0,o.w5)((()=>[(0,o._)("div",s,[(0,o.wy)((0,o.Wm)(h,{label:"Close",color:"primary",flat:""},null,512),[[q]])])])),_:1},8,["modelValue"])])),_:1})])),_:1})])),_:1},8,["modelValue"]),(0,o.Wm)(f,{"use-input":"","map-options":"","emit-value":"",label:"Champions","input-debounce":"0",modelValue:t.filter.champion_id,"onUpdate:modelValue":e[2]||(e[2]=e=>t.filter.champion_id=e),options:t.options.champions,onFilter:c.filterChampions},null,8,["modelValue","options","onFilter"]),(0,o.Wm)(f,{"use-input":"","map-options":"","emit-value":"",label:"Sport","input-debounce":"0",modelValue:t.filter.sport_id,"onUpdate:modelValue":e[3]||(e[3]=e=>t.filter.sport_id=e),options:t.options.sports,onFilter:c.filterSport},null,8,["modelValue","options","onFilter"]),(0,o.Wm)(f,{"use-input":"","map-options":"","emit-value":"",label:"School","input-debounce":"0",modelValue:t.filter.school_id,"onUpdate:modelValue":e[4]||(e[4]=e=>t.filter.school_id=e),options:t.options.schools,onFilter:c.filterSchool},{option:(0,o.w5)((t=>[(0,o.Wm)(v,(0,a.vs)((0,o.F4)(t.itemProps)),{default:(0,o.w5)((()=>[(0,o.Wm)(w,{avatar:""},{default:(0,o.w5)((()=>[(0,o.Wm)(_,{src:t.opt.icon},null,8,["src"])])),_:2},1024),(0,o.Wm)(w,null,{default:(0,o.w5)((()=>[(0,o.Wm)(b,null,{default:(0,o.w5)((()=>[(0,o.Uk)((0,a.zw)(t.opt.label),1)])),_:2},1024)])),_:2},1024)])),_:2},1040)])),_:1},8,["modelValue","options","onFilter"])])),_:1}),(0,o.Wm)(y,{align:"right"},{default:(0,o.w5)((()=>[(0,o.Wm)(h,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:c.clearFilter},null,8,["onClick"]),(0,o.Wm)(h,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:c.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}i(4110),i(702);var r=i(7682);const c={school_id:null,champion_id:null,sport_id:null,date:null},d={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...c},options:{schools:[],champions:[],sports:[]},master:{schools:[],champions:[],sports:[]}}},watch:{show:function(t){this.visible=t,t||this.hide()}},mounted:function(){this.getSchools(),this.getChampions(),this.getSports()},methods:{clearFilter:function(){this.filter={...c},this.$emit("filter",this.filter),this.hide()},filterSchool:function(t,e){e((()=>{const e=t.toLowerCase();this.options.schools=this.master.schools.filter((t=>t.label.toLowerCase().indexOf(e)>-1))}))},filterChampions:function(t,e){e((()=>{const e=t.toLowerCase();this.options.champions=this.master.champions.filter((t=>t.label.toLowerCase().indexOf(e)>-1))}))},filterSport:function(t,e){e((()=>{const e=t.toLowerCase();this.options.sports=this.master.sports.filter((t=>t.label.toLowerCase().indexOf(e)>-1))}))},getSchools:function(t=null){r.Z.loading(this),this.options.schools=[],this.master.schools=[],window.localStorage.removeItem("masterdata_schools");let e="school/list";e=r.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((t=>{const{data:e,message:i,status:o}=t.data;if(o){const t=[];e.list.map((e=>{t.push({label:e.name,value:e.id,icon:`${this.$host}/storage/school/logo/${e.logo}`})})),this.options.schools=[...t],this.master.schools=[...t],window.localStorage.setItem("masterdata_schools",JSON.stringify(t))}})).finally((()=>{this.filter.school_id="undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,r.Z.loading(this,!1)}))},getSports:function(t=null){this.options.sports=[],this.master.sports=[],window.localStorage.removeItem("masterdata_sports"),r.Z.loading(this);let e="sport/list";e=r.Z.generateURLParams(e,"showall",!0),null!==t&&(e=r.Z.generateURLParams(e,"champion_id",t)),this.$api.get(e).then((t=>{const{data:e,message:i,status:o}=t.data;if(o){const t=[];e.list.map((e=>{t.push({label:e.name,value:e.id})})),this.options.sports=[...t],this.master.sports=[...t],window.localStorage.setItem("masterdata_sports",JSON.stringify(t))}})).finally((()=>{r.Z.loading(this,!1)}))},getChampions:function(){this.options.champions=[],this.master.champions=[],window.localStorage.removeItem("masterdata_champions"),r.Z.loading(this);let t="championship/list";t=r.Z.generateURLParams(t,"showall",!0),this.$api.get(t).then((t=>{const{data:e,message:i,status:o}=t.data;if(o){const t=[];e.list.map((e=>{t.push({label:e.abbreviation,value:e.id})})),this.options.champions=[...t],this.master.champions=[...t],window.localStorage.setItem("masterdata_champions",JSON.stringify(t))}})).finally((()=>{r.Z.loading(this,!1)}))},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var h=i(1639),p=i(2074),u=i(4458),m=i(3190),g=i(1852),f=i(2857),_=i(2765),w=i(7088),b=i(4455),v=i(8379),y=i(490),Z=i(1233),x=i(335),q=i(3115),$=i(1821),S=i(2146),W=i(9984),k=i.n(W);const C=(0,h.Z)(d,[["render",n]]),V=C;k()(d,"components",{QDialog:p.Z,QCard:u.Z,QCardSection:m.Z,QInput:g.Z,QIcon:f.Z,QPopupProxy:_.Z,QDate:w.Z,QBtn:b.Z,QSelect:v.Z,QItem:y.Z,QItemSection:Z.Z,QImg:x.Z,QItemLabel:q.Z,QCardActions:$.Z}),k()(d,"directives",{ClosePopup:S.Z})},7658:(t,e,i)=>{i.r(e),i.d(e,{default:()=>it});var o=i(9835),a=i(6970);const l=t=>((0,o.dD)("data-v-80b1b31a"),t=t(),(0,o.Cn)(),t),s=l((()=>(0,o._)("div",{class:"bg-secondary q-py-xl q-pt-md"},[(0,o._)("div",{class:"text-h5 text-center text-bold"}," Scores ")],-1))),n={class:"q-pt-xl page bg-accent"},r={key:0},c={class:"card-schedule-container"},d={class:"left"},h={class:"full-width text-center q-mt-md"},p=["src"],u={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},m={class:"text-caption"},g={class:"text-body1"},f={class:"right"},_={class:"full-width text-center q-mt-md"},w=["src"],b={class:"text-bold text-white text q-mt-xs text-center",style:{"line-height":"1"}},v={class:"text-caption"},y={class:"text-body1"},Z={key:0,class:"center"},x=["src"],q={class:"top-left"},$=(0,o.Uk)(" Live "),S={key:0},W={class:"capitalize"},k={key:1,class:"top-right"},C=["src"],V={class:"top",style:{top:"30%"}},P={class:"bottom",style:{bottom:"30%"}},Q=l((()=>(0,o._)("div",{class:"bottom text-caption",style:{bottom:"2%","font-size":"0.6em","letter-spacing":"2px"}}," WWW.SCHSPORTS.COM ",-1))),F={class:"flex flex-center q-py-md"},L={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function D(t,e,i,l,D,U){const I=(0,o.up)("q-tab"),z=(0,o.up)("q-tabs"),R=(0,o.up)("q-img"),T=(0,o.up)("q-card-section"),O=(0,o.up)("q-card"),M=(0,o.up)("q-spinner-dots"),H=(0,o.up)("q-infinite-scroll"),j=(0,o.up)("q-inner-loading"),A=(0,o.up)("q-pull-to-refresh"),N=(0,o.up)("match-filter"),E=(0,o.up)("q-page");return(0,o.wg)(),(0,o.j4)(E,null,{default:(0,o.w5)((()=>[s,(0,o.Wm)(z,{modelValue:t.tab,"onUpdate:modelValue":[e[0]||(e[0]=e=>t.tab=e),e[1]||(e[1]=()=>t.getSchedule(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,o.w5)((()=>[(0,o.Wm)(I,{name:"have-played",label:"Score Today"}),(0,o.Wm)(I,{name:"last-week",label:"This Week"})])),_:1},8,["modelValue"]),"highlight"!==t.tab?((0,o.wg)(),(0,o.j4)(A,{key:0,onRefresh:t.refresh},{default:(0,o.w5)((()=>[(0,o._)("div",n,[t.schedules.length>0?((0,o.wg)(),(0,o.iD)("div",r,[(0,o.Wm)(H,{onLoad:t.loadMore},{loading:(0,o.w5)((()=>[(0,o._)("div",F,[(0,o.Wm)(M,{color:"accent",size:"40px"})])])),default:(0,o.w5)((()=>[(0,o._)("div",c,[((0,o.wg)(!0),(0,o.iD)(o.HY,null,(0,o.Ko)(t.schedules,(e=>((0,o.wg)(),(0,o.j4)(O,{key:e.id,class:"event-card",onClick:()=>t.redirect(e.id)},{default:(0,o.w5)((()=>[(0,o.Wm)(T,{class:"q-py-lg schedule-team-logo",style:(0,a.j5)({backgroundImage:"linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('"+e.link_stream.image_link+"')",color:"white",textShadow:"-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"})},{default:(0,o.w5)((()=>[(0,o._)("div",d,[(0,o._)("div",h,[(0,o._)("div",null,[(0,o.Wm)(R,{class:"logo",src:`${t.$host}/storage/school/logo/${e.school1.logo}`,ratio:1,width:"40%"},{error:(0,o.w5)((()=>[(0,o._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,p)])),_:2},1032,["src"])]),(0,o._)("div",u,[(0,o._)("span",m,(0,a.zw)(e.school1.name),1),(0,o._)("div",g,(0,a.zw)(e.score1||"-"),1)])])]),(0,o._)("div",f,[(0,o._)("div",_,[(0,o._)("div",null,[(0,o.Wm)(R,{class:"logo",src:`${t.$host}/storage/school/logo/${e.school2.logo}`,ratio:1,width:"40%"},{error:(0,o.w5)((()=>[(0,o._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,w)])),_:2},1032,["src"])]),(0,o._)("div",b,[(0,o._)("span",v,(0,a.zw)(e.school2.name),1),(0,o._)("div",y,(0,a.zw)(e.score2||"-"),1)])])]),null!==t.logo?((0,o.wg)(),(0,o.iD)("div",Z,[(0,o.Wm)(R,{class:"logo",src:`${t.$host}/storage/app/image/${t.logo}`,ratio:1},{error:(0,o.w5)((()=>[(0,o._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,x)])),_:1},8,["src"])])):(0,o.kq)("",!0),(0,o._)("div",q,[$,null!==e.team_type?((0,o.wg)(),(0,o.iD)("span",S,"  "+(0,a.zw)(e.team_type.name),1)):(0,o.kq)("",!0),(0,o._)("span",W,"  "+(0,a.zw)(e.team_gender),1),(0,o._)("span",null,"  "+(0,a.zw)(e.sport.name),1)]),null!==e.championship?((0,o.wg)(),(0,o.iD)("div",k,[(0,o.Wm)(R,{class:"logo",src:`${t.$host}/storage/championship/image/${e.championship.image}`,ratio:1},{error:(0,o.w5)((()=>[(0,o._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,C)])),_:2},1032,["src"])])):(0,o.kq)("",!0),(0,o._)("div",V,(0,a.zw)(t.scheduleDate(e.datetime)),1),(0,o._)("div",P,(0,a.zw)(t.scheduleTime(e.datetime)),1),Q])),_:2},1032,["style"])])),_:2},1032,["onClick"])))),128))])])),_:1},8,["onLoad"])])):((0,o.wg)(),(0,o.iD)("div",L," No Data ")),(0,o.Wm)(j,{showing:t.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"])):(0,o.kq)("",!0),(0,o.Wm)(N,{show:t.filter.dialog,onHide:t.hideFilterDialog,onFilter:t.onFilter},null,8,["show","onHide","onFilter"])])),_:1})}i(4110),i(702),i(9829);var U=i(3878),I=i.n(U),z=i(5457),R=i(3562),T=i(7682);const O=(0,o.aZ)({name:"IndexPage",components:{MatchFilter:R.Z},data:function(){return{logo:null,title:null,slide:0,banners:[],videos:[],filter:{dialog:!1,data:{school_id:"undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,champion_id:null,sport_id:null,date:null}},loadingSchedule:!1,tab:"have-played",has_filter:!1,schedules:[],pagination:{page:1,total_page:1},pagination_video:{page:1,total_page:1}}},mounted:function(){this.getAppData();const t=this.$route.query.tab;"undefined"!==typeof t&&(this.tab=t,T.Z.scrollToElement(this.$refs.tab.$el)),null!==this.filter.data.school_id?(this.filter.data.school_id=this.filter.data.school_id,this.onFilter(this.filter.data)):this.getSchedule(),(0,z.Z)({title:"Home"})},watch:{tab:function(t){"highlight"===t&&this.getVideo()}},methods:{nextVideoPage:function(){this.pagination_video.page++,this.getVideo()},getVideo:function(t="have-played"){return T.Z.loading(this),new Promise(((e,i)=>{const o=this.pagination_video.page;let a="match-schedule/list";a=T.Z.generateURLParams(a,"page",o),a=T.Z.generateURLParams(a,"limit",10),a=T.Z.generateURLParams(a,"type",t),this.$api.get(a).then((t=>{const{data:o,message:a,status:l}=t.data;if(l){const t=[...this.videos];this.videos=[...t,...o.list],this.pagination_video={page:o.pagination.page,total_page:o.pagination.total_page},e()}else i()})).finally((()=>{T.Z.loading(this,!1)}))}))},onFilter:async function(t){this.filter.data={...t},null!==this.filter.data.date&&(this.tab=null),await this.getSchedule(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(t,e){const i=this.pagination.page;i<this.pagination.total_page&&(this.pagination.page=parseInt(i)+1,await this.getSchedule()),e()},redirect:function(t){},refresh:async function(t){await this.getSchedule(1),t()},scheduleDate:function(t){const e=I().utc(t).local().format("D MMMM Y");return e},scheduleTime:function(t){const e=I().utc(t).local().format("hh:mm"),i=I().tz.guess(),o=I().tz(i).zoneAbbr();return`${e} ${o}`},getAppData:function(){this.$api.get("app/detail").then((t=>{const{data:e,message:i,status:o}=t.data;this.title=e.name,this.logo=e.logo}))},getSchedule:function(t=null){return null!==t&&(this.pagination.page=t),this.loadingSchedule=!0,new Promise(((t,e)=>{const i=this.pagination.page;let o="match-schedule/list";o=T.Z.generateURLParams(o,"page",i),o=T.Z.generateURLParams(o,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([t,e])=>{null!==e&&(this.has_filter=!0,o=T.Z.generateURLParams(o,t,e))})),this.$api.get(o).then((i=>{const{data:o,message:a,status:l}=i.data;l?(1===this.pagination.page?this.schedules=[...o.list]:this.schedules=this.schedules.concat(o.list),this.pagination={...this.pagination,page:o.pagination.page,total_page:o.pagination.total_page},t()):e()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var M=i(1639),H=i(9885),j=i(7817),A=i(7661),N=i(699),E=i(6870),J=i(4458),B=i(3190),Y=i(335),K=i(7501),G=i(854),X=i(9984),tt=i.n(X);const et=(0,M.Z)(O,[["render",D],["__scopeId","data-v-80b1b31a"]]),it=et;tt()(O,"components",{QPage:H.Z,QTabs:j.Z,QTab:A.Z,QPullToRefresh:N.Z,QInfiniteScroll:E.Z,QCard:J.Z,QCardSection:B.Z,QImg:Y.Z,QSpinnerDots:K.Z,QInnerLoading:G.Z})}}]);