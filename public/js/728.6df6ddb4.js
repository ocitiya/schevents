"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[728],{7682:(e,t,a)=>{a.d(t,{Z:()=>n});a(6727);var l=a(3701),i=a(9302);const{getScrollTarget:s,setVerticalScrollPosition:o}=l.ZP;(0,i.Z)();class n{static generateURLParams(e,t,a){return e.includes("?")?e+=`&${t}=${a}`:e+=`?${t}=${a}`,e}static scrollToElement(e,t=null){const a=s(e),l=null===t?e.offsetTop:t,i=500;o(a,l,i)}static loading(e,t=!0,a=null){t?e.$q.loading.show({message:null===a?"Loading ...":a}):e.$q.loading.hide()}}},3728:(e,t,a)=>{a.r(t),a.d(t,{default:()=>at});var l=a(9835),i=a(6970);const s=e=>((0,l.dD)("data-v-3824e176"),e=e(),(0,l.Cn)(),e),o={class:"text-right bg-secondary q-pr-md q-pt-lg q-gutter-x-sm"},n=s((()=>(0,l._)("div",{class:"bg-secondary q-pb-xl q-pt-md"},[(0,l._)("div",{class:"text-h5 text-center text-bold"}," Athlete Schedule ")],-1))),r={class:"q-pt-xl page bg-accent"},d={key:0},h={class:"card-schedule-container"},c={class:"left"},p={class:"full-width text-center"},m=["src"],g={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},u={class:"right"},f={class:"full-width text-center"},w=["src"],_={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},b={key:0,class:"center"},y=["src"],v={class:"top-left"},x=(0,l.Uk)(" Live  "),k={key:0},q=(0,l.Uk)("  "),$={class:"capitalize"},W=(0,l.Uk)("  "),Z={key:1,class:"top-right"},S=["src"],C={class:"top",style:{top:"30%"}},D={class:"bottom",style:{bottom:"30%"}},z=s((()=>(0,l._)("div",{class:"bottom text-caption",style:{bottom:"2%","font-size":"0.6em","letter-spacing":"2px"}}," WWW.SCHSPORTS.COM ",-1))),Q={key:0,class:"capitalize"},U={key:1},L={key:2},P={key:3},V={class:"flex flex-center q-py-md"},F={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"},I={key:1},T={class:"q-py-xl page bg-accent"},R={key:0},j={class:"q-gutter-md flex"},A={class:"left"},H={class:"full-width text-center"},M=["src"],O={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},N={class:"right"},B={class:"full-width text-center"},E=["src"],J={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},Y={key:0,class:"center"},K=["src"],G={class:"top-left"},X={key:0},ee=(0,l.Uk)("  "),te={class:"capitalize"},ae=(0,l.Uk)("  "),le={key:1,class:"top-right"},ie=["src"],se={class:"top",style:{top:"30%"}},oe={class:"bottom",style:{bottom:"30%"}},ne=s((()=>(0,l._)("div",{class:"bottom text-caption",style:{bottom:"2%","font-size":"0.6em","letter-spacing":"2px"}}," WWW.SCHSPORTS.COM ",-1))),re={class:"flex items-center justify-between"},de={class:"text-body1 q-mt-sm"},he=s((()=>(0,l._)("hr",null,null,-1))),ce=["innerHTML"],pe={key:0,class:"flex items-center justify-center q-mt-md"},me={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function ge(e,t,a,s,ge,ue){const fe=(0,l.up)("q-btn"),we=(0,l.up)("q-badge"),_e=(0,l.up)("q-tab"),be=(0,l.up)("q-tabs"),ye=(0,l.up)("q-img"),ve=(0,l.up)("q-card-section"),xe=(0,l.up)("q-separator"),ke=(0,l.up)("q-card"),qe=(0,l.up)("q-spinner-dots"),$e=(0,l.up)("q-infinite-scroll"),We=(0,l.up)("q-inner-loading"),Ze=(0,l.up)("q-pull-to-refresh"),Se=(0,l.up)("q-icon"),Ce=(0,l.up)("athlete-filter"),De=(0,l.up)("q-page"),ze=(0,l.Q2)("ripple");return(0,l.wg)(),(0,l.j4)(De,null,{default:(0,l.w5)((()=>[(0,l._)("div",o,[(0,l.Wm)(fe,{label:"Club Schedule",unelevated:"",color:"primary",onClick:t[0]||(t[0]=t=>e.$router.push({name:"schedule-team"}))}),(0,l.Wm)(fe,{label:"filter",icon:"filter_alt",unelevated:"",color:"primary",onClick:e.showFilterDialog},{default:(0,l.w5)((()=>[e.has_filter?((0,l.wg)(),(0,l.j4)(we,{key:0,floating:"",color:"white",rounded:""})):(0,l.kq)("",!0)])),_:1},8,["onClick"])]),n,(0,l.Wm)(be,{modelValue:e.tab,"onUpdate:modelValue":[t[1]||(t[1]=t=>e.tab=t),t[2]||(t[2]=()=>e.getSchedule(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,l.w5)((()=>[(0,l.Wm)(_e,{name:"live",label:"Live"}),(0,l.Wm)(_e,{name:"upcoming",label:"Upcoming"}),(0,l.Wm)(_e,{name:"this-week",label:"This Week"}),(0,l.Wm)(_e,{name:"today",label:"Today"}),(0,l.Wm)(_e,{name:"tomorrow",label:"Tomorrow"}),(0,l.Wm)(_e,{name:"highlight",label:"Highlight"})])),_:1},8,["modelValue"]),"highlight"!==e.tab?((0,l.wg)(),(0,l.j4)(Ze,{key:0,onRefresh:e.refresh},{default:(0,l.w5)((()=>[(0,l._)("div",r,[e.schedules.length>0?((0,l.wg)(),(0,l.iD)("div",d,[(0,l.Wm)($e,{onLoad:e.loadMore},{loading:(0,l.w5)((()=>[(0,l._)("div",V,[(0,l.Wm)(qe,{color:"accent",size:"40px"})])])),default:(0,l.w5)((()=>[(0,l._)("div",h,[((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(e.schedules,(t=>(0,l.wy)(((0,l.wg)(),(0,l.j4)(ke,{key:t.id,class:"event-card",onClick:()=>e.redirect(t.id)},{default:(0,l.w5)((()=>[(0,l.Wm)(ve,{class:"q-py-lg schedule-team-logo",style:(0,i.j5)({backgroundImage:"linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('"+t.link_stream.image_link+"')",color:"white",textShadow:"-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"})},{default:(0,l.w5)((()=>[(0,l._)("div",c,[(0,l._)("div",p,[(0,l._)("div",null,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/athlete/image/${t.athlete1.image}`,ratio:1,width:"40%"},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,m)])),_:2},1032,["src"])]),(0,l._)("div",g,(0,i.zw)(t.athlete1.name),1)])]),(0,l._)("div",u,[(0,l._)("div",f,[(0,l._)("div",null,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/athlete/image/${t.athlete2.image}`,ratio:1,width:"40%"},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,w)])),_:2},1032,["src"])]),(0,l._)("div",_,(0,i.zw)(t.athlete2.name),1)])]),null!==e.logo?((0,l.wg)(),(0,l.iD)("div",b,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/app/image/${e.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,y)])),_:1},8,["src"])])):(0,l.kq)("",!0),(0,l._)("div",v,[x,null!==t.team_type?((0,l.wg)(),(0,l.iD)("span",k,(0,i.zw)(t.team_type.name),1)):(0,l.kq)("",!0),q,(0,l._)("span",$,(0,i.zw)(t.team_gender),1),W,(0,l._)("span",null,(0,i.zw)(t.sport.name),1)]),null!==t.championship?((0,l.wg)(),(0,l.iD)("div",Z,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/championship/image/${t.championship.image}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,S)])),_:2},1032,["src"])])):(0,l.kq)("",!0),(0,l._)("div",C,(0,i.zw)(e.scheduleDate(t.datetime)),1),(0,l._)("div",D,(0,i.zw)(e.scheduleTime(t.datetime)),1),z])),_:2},1032,["style"]),(0,l.Wm)(xe),(0,l.Wm)(ve,{class:"text-justify q-px-md bg-secondary text-accent text-bold"},{default:(0,l.w5)((()=>[(0,l._)("span",null," Watch: "+(0,i.zw)(t.athlete1.name)+" vs "+(0,i.zw)(t.athlete2.name)+" - "+(0,i.zw)(e.scheduleTime(t.datetime))+" - "+(0,i.zw)(e.scheduleDate(t.datetime))+" - ",1),null!==t.team_gender?((0,l.wg)(),(0,l.iD)("span",Q,(0,i.zw)(t.team_gender)+" ",1)):(0,l.kq)("",!0),null!==t.sport?((0,l.wg)(),(0,l.iD)("span",U,(0,i.zw)(t.sport.name),1)):null!==t.sport_type?((0,l.wg)(),(0,l.iD)("span",L,(0,i.zw)(t.sport_type.name),1)):(0,l.kq)("",!0),null!==t.stadium?((0,l.wg)(),(0,l.iD)("span",P," - Live from "+(0,i.zw)(t.stadium.name),1)):(0,l.kq)("",!0)])),_:2},1024)])),_:2},1032,["onClick"])),[[ze]]))),128))])])),_:1},8,["onLoad"])])):((0,l.wg)(),(0,l.iD)("div",F," No Upcoming Events ")),(0,l.Wm)(We,{showing:e.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"])):(0,l.kq)("",!0),"highlight"===e.tab?((0,l.wg)(),(0,l.iD)("div",I,[(0,l._)("div",T,[e.videos.length>0?((0,l.wg)(),(0,l.iD)("div",R,[(0,l._)("div",j,[((0,l.wg)(!0),(0,l.iD)(l.HY,null,(0,l.Ko)(e.videos,(t=>((0,l.wg)(),(0,l.j4)(ke,{key:t.id,class:"bg-white q-pa-md event-card",bordered:"",onClick:()=>e.toDetail(t.id)},{default:(0,l.w5)((()=>[(0,l.Wm)(ve,{class:"q-py-lg schedule-team-logo",style:(0,i.j5)({backgroundImage:"linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('"+t.link_stream.image_link+"')",color:"white",textShadow:"-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"})},{default:(0,l.w5)((()=>[(0,l._)("div",A,[(0,l._)("div",H,[(0,l._)("div",null,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/athlete/image/${t.athlete1.image}`,ratio:1,width:"40%"},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,M)])),_:2},1032,["src"])]),(0,l._)("div",O,(0,i.zw)(t.athlete1.name),1)])]),(0,l._)("div",N,[(0,l._)("div",B,[(0,l._)("div",null,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/athlete/logo/${t.athlete2.image}`,ratio:1,width:"40%"},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,E)])),_:2},1032,["src"])]),(0,l._)("div",J,(0,i.zw)(t.athlete2.name),1)])]),null!==e.logo?((0,l.wg)(),(0,l.iD)("div",Y,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/app/image/${e.logo}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,K)])),_:1},8,["src"])])):(0,l.kq)("",!0),(0,l._)("div",G,[null!==t.team_type?((0,l.wg)(),(0,l.iD)("span",X,(0,i.zw)(t.team_type.name),1)):(0,l.kq)("",!0),ee,(0,l._)("span",te,(0,i.zw)(t.team_gender),1),ae,(0,l._)("span",null,(0,i.zw)(t.sport.name),1)]),null!==t.championship?((0,l.wg)(),(0,l.iD)("div",le,[(0,l.Wm)(ye,{class:"logo",src:`${e.$host}/storage/championship/image/${t.championship.image}`,ratio:1},{error:(0,l.w5)((()=>[(0,l._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,ie)])),_:2},1032,["src"])])):(0,l.kq)("",!0),(0,l._)("div",se,(0,i.zw)(e.scheduleDate(t.datetime)),1),(0,l._)("div",oe,(0,i.zw)(e.scheduleTime(t.datetime)),1),ne])),_:2},1032,["style"]),(0,l.Wm)(xe),(0,l.Wm)(ve,{class:"text-justify q-px-md"},{default:(0,l.w5)((()=>[(0,l._)("div",re,[(0,l._)("div",null,[(0,l._)("small",null,[(0,l.Wm)(Se,{name:"calendar_month"}),(0,l.Uk)(" "+(0,i.zw)(e.scheduleDate(t.datetime)),1)])]),(0,l._)("div",null,[(0,l._)("small",null,[(0,l.Wm)(Se,{name:"schedule"}),(0,l.Uk)(" "+(0,i.zw)(e.scheduleTime(t.datetime)),1)])])]),(0,l._)("div",de," Watch: "+(0,i.zw)(t.athlete1.name)+" vs "+(0,i.zw)(t.athlete2.name),1),he,(0,l._)("div",{class:"text-description",innerHTML:t.description},null,8,ce)])),_:2},1024)])),_:2},1032,["onClick"])))),128))]),e.pagination_video.page<e.pagination_video.total_page?((0,l.wg)(),(0,l.iD)("div",pe,[(0,l.Wm)(fe,{class:"",label:"See More",color:"primary",onClick:e.nextVideoPage},null,8,["onClick"])])):(0,l.kq)("",!0)])):((0,l.wg)(),(0,l.iD)("div",me," No Data Available "))])])):(0,l.kq)("",!0),(0,l.Wm)(Ce,{show:e.filter.dialog,onHide:e.hideFilterDialog,onFilter:e.onFilter},null,8,["show","onHide","onFilter"])])),_:1})}a(4110),a(702),a(9829);var ue=a(3878),fe=a.n(ue),we=a(5457);const _e=(0,l._)("div",{class:"text-h6 text-primary"},"Filter",-1),be={class:"row items-center justify-end"};function ye(e,t,a,s,o,n){const r=(0,l.up)("q-card-section"),d=(0,l.up)("q-btn"),h=(0,l.up)("q-date"),c=(0,l.up)("q-popup-proxy"),p=(0,l.up)("q-icon"),m=(0,l.up)("q-input"),g=(0,l.up)("q-select"),u=(0,l.up)("q-img"),f=(0,l.up)("q-item-section"),w=(0,l.up)("q-item-label"),_=(0,l.up)("q-item"),b=(0,l.up)("q-card-actions"),y=(0,l.up)("q-card"),v=(0,l.up)("q-dialog"),x=(0,l.Q2)("close-popup");return(0,l.wg)(),(0,l.iD)("div",null,[(0,l.Wm)(v,{modelValue:e.visible,"onUpdate:modelValue":t[5]||(t[5]=t=>e.visible=t),onHide:n.hide,position:"bottom"},{default:(0,l.w5)((()=>[(0,l.Wm)(y,{class:"card-bottom"},{default:(0,l.w5)((()=>[(0,l.Wm)(r,null,{default:(0,l.w5)((()=>[_e])),_:1}),(0,l.Wm)(r,{class:"q-pt-none"},{default:(0,l.w5)((()=>[(0,l.Wm)(m,{modelValue:e.filter.date,"onUpdate:modelValue":t[1]||(t[1]=t=>e.filter.date=t),mask:"date",readonly:"",label:"Date"},{append:(0,l.w5)((()=>[(0,l.Wm)(p,{name:"event",class:"cursor-pointer"},{default:(0,l.w5)((()=>[(0,l.Wm)(c,{cover:"","transition-show":"scale","transition-hide":"scale"},{default:(0,l.w5)((()=>[(0,l.Wm)(h,{modelValue:e.filter.date,"onUpdate:modelValue":t[0]||(t[0]=t=>e.filter.date=t)},{default:(0,l.w5)((()=>[(0,l._)("div",be,[(0,l.wy)((0,l.Wm)(d,{label:"Close",color:"primary",flat:""},null,512),[[x]])])])),_:1},8,["modelValue"])])),_:1})])),_:1})])),_:1},8,["modelValue"]),(0,l.Wm)(g,{"use-input":"","map-options":"","emit-value":"",label:"Champions","input-debounce":"0",modelValue:e.filter.champion_id,"onUpdate:modelValue":t[2]||(t[2]=t=>e.filter.champion_id=t),options:e.options.champions,onFilter:n.filterChampions},null,8,["modelValue","options","onFilter"]),(0,l.Wm)(g,{"use-input":"","map-options":"","emit-value":"",label:"Sport","input-debounce":"0",modelValue:e.filter.sport_id,"onUpdate:modelValue":t[3]||(t[3]=t=>e.filter.sport_id=t),options:e.options.sports,onFilter:n.filterSport},null,8,["modelValue","options","onFilter"]),(0,l.Wm)(g,{"use-input":"","map-options":"","emit-value":"",label:"Athlete","input-debounce":"0",modelValue:e.filter.athlete_id,"onUpdate:modelValue":t[4]||(t[4]=t=>e.filter.athlete_id=t),options:e.options.athletes,onFilter:n.filterAthlete},{option:(0,l.w5)((e=>[(0,l.Wm)(_,(0,i.vs)((0,l.F4)(e.itemProps)),{default:(0,l.w5)((()=>[(0,l.Wm)(f,{avatar:""},{default:(0,l.w5)((()=>[(0,l.Wm)(u,{src:e.opt.icon},null,8,["src"])])),_:2},1024),(0,l.Wm)(f,null,{default:(0,l.w5)((()=>[(0,l.Wm)(w,null,{default:(0,l.w5)((()=>[(0,l.Uk)((0,i.zw)(e.opt.label),1)])),_:2},1024)])),_:2},1024)])),_:2},1040)])),_:1},8,["modelValue","options","onFilter"])])),_:1}),(0,l.Wm)(b,{align:"right"},{default:(0,l.w5)((()=>[(0,l.Wm)(d,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:n.clearFilter},null,8,["onClick"]),(0,l.Wm)(d,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:n.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}var ve=a(7682);const xe={athlete_id:null,champion_id:null,sport_id:null,date:null},ke={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...xe},options:{athletes:[],champions:[],sports:[]},master:{athletes:[],champions:[],sports:[]}}},watch:{show:function(e){this.visible=e,e||this.hide()}},mounted:function(){this.getAthletes(),this.getChampions(),this.getSports()},methods:{clearFilter:function(){this.filter={...xe},this.$emit("filter",this.filter),this.hide()},filterAthlete:function(e,t){t((()=>{const t=e.toLowerCase();this.options.athletes=this.master.athletes.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},filterChampions:function(e,t){t((()=>{const t=e.toLowerCase();this.options.champions=this.master.champions.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},filterSport:function(e,t){t((()=>{const t=e.toLowerCase();this.options.sports=this.master.sports.filter((e=>e.label.toLowerCase().indexOf(t)>-1))}))},getAthletes:function(e=null){ve.Z.loading(this),this.options.athletes=[],this.master.athletes=[],window.localStorage.removeItem("masterdata_athletes");let t="athlete/list";t=ve.Z.generateURLParams(t,"showall",!0),this.$api.get(t).then((e=>{const{data:t,message:a,status:l}=e.data;if(l){const e=[];t.list.map((t=>{e.push({label:t.name,value:t.id,icon:`${this.$host}/storage/athlete/image/${t.image}`})})),this.options.athletes=[...e],this.master.athletes=[...e],window.localStorage.setItem("masterdata_athletes",JSON.stringify(e))}})).finally((()=>{this.filter.athlete_id="undefined"!==typeof this.$route.query.athlete_id?parseInt(this.$route.query.athlete_id):null,ve.Z.loading(this,!1)}))},getSports:function(e=null){this.options.sports=[],this.master.sports=[],window.localStorage.removeItem("masterdata_sports"),ve.Z.loading(this);let t="sport/list";t=ve.Z.generateURLParams(t,"showall",!0),null!==e&&(t=ve.Z.generateURLParams(t,"champion_id",e)),this.$api.get(t).then((e=>{const{data:t,message:a,status:l}=e.data;if(l){const e=[];t.list.map((t=>{e.push({label:t.name,value:t.id})})),this.options.sports=[...e],this.master.sports=[...e],window.localStorage.setItem("masterdata_sports",JSON.stringify(e))}})).finally((()=>{ve.Z.loading(this,!1)}))},getChampions:function(){this.options.champions=[],this.master.champions=[],window.localStorage.removeItem("masterdata_champions"),ve.Z.loading(this);let e="championship/list";e=ve.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((e=>{const{data:t,message:a,status:l}=e.data;if(l){const e=[];t.list.map((t=>{e.push({label:t.abbreviation,value:t.id})})),this.options.champions=[...e],this.master.champions=[...e],window.localStorage.setItem("masterdata_champions",JSON.stringify(e))}})).finally((()=>{ve.Z.loading(this,!1)}))},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var qe=a(1639),$e=a(2074),We=a(4458),Ze=a(3190),Se=a(1852),Ce=a(2857),De=a(2765),ze=a(7088),Qe=a(4455),Ue=a(8379),Le=a(490),Pe=a(1233),Ve=a(335),Fe=a(3115),Ie=a(1821),Te=a(2146),Re=a(9984),je=a.n(Re);const Ae=(0,qe.Z)(ke,[["render",ye]]),He=Ae;je()(ke,"components",{QDialog:$e.Z,QCard:We.Z,QCardSection:Ze.Z,QInput:Se.Z,QIcon:Ce.Z,QPopupProxy:De.Z,QDate:ze.Z,QBtn:Qe.Z,QSelect:Ue.Z,QItem:Le.Z,QItemSection:Pe.Z,QImg:Ve.Z,QItemLabel:Fe.Z,QCardActions:Ie.Z}),je()(ke,"directives",{ClosePopup:Te.Z});const Me=(0,l.aZ)({name:"IndexPage",components:{AthleteFilter:He},data:function(){return{logo:null,title:null,slide:0,banners:[],videos:[],filter:{dialog:!1,data:{athlete_id:"undefined"!==typeof this.$route.query.athlete_id?parseInt(this.$route.query.athlete_id):null,champion_id:null,sport_id:null,date:null}},loadingSchedule:!1,tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1},pagination_video:{page:1,total_page:1}}},mounted:function(){this.getAppData();const e=this.$route.query.tab;"undefined"!==typeof e&&(this.tab=e,ve.Z.scrollToElement(this.$refs.tab.$el)),null!==this.filter.data.athlete_id?(this.filter.data.athlete_id=this.filter.data.athlete_id,this.onFilter(this.filter.data)):this.getSchedule(),(0,we.Z)({title:"Home"})},watch:{tab:function(e){"highlight"===e&&this.getVideo()}},methods:{nextVideoPage:function(){this.pagination_video.page++,this.getVideo()},getVideo:function(e="have-played"){return ve.Z.loading(this),new Promise(((t,a)=>{const l=this.pagination_video.page;let i="athlete-schedule/list";i=ve.Z.generateURLParams(i,"page",l),i=ve.Z.generateURLParams(i,"limit",10),i=ve.Z.generateURLParams(i,"type",e),this.$api.get(i).then((e=>{const{data:l,message:i,status:s}=e.data;if(s){const e=[...this.videos];this.videos=[...e,...l.list],this.pagination_video={page:l.pagination.page,total_page:l.pagination.total_page},t()}else a()})).finally((()=>{ve.Z.loading(this,!1)}))}))},onFilter:async function(e){this.filter.data={...e},null!==this.filter.data.date&&(this.tab=null),await this.getSchedule(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(e,t){const a=this.pagination.page;a<this.pagination.total_page&&(this.pagination.page=parseInt(a)+1,await this.getSchedule()),t()},redirect:function(e){setTimeout((()=>{window.open(`${this.$host}/athlete/schedule/${e}`)}),300)},refresh:async function(e){await this.getSchedule(1),e()},scheduleDate:function(e){const t=fe().utc(e).local().format("D MMMM Y");return t},scheduleTime:function(e){const t=fe().utc(e).local().format("hh:mm"),a=fe().tz.guess(),l=fe().tz(a).zoneAbbr();return`${t} ${l}`},getAppData:function(){this.$api.get("app/detail").then((e=>{const{data:t,message:a,status:l}=e.data;this.title=t.name,this.logo=t.logo}))},getSchedule:function(e=null){return null!==e&&(this.pagination.page=e),this.loadingSchedule=!0,new Promise(((e,t)=>{const a=this.pagination.page;let l="athlete-schedule/list";l=ve.Z.generateURLParams(l,"page",a),l=ve.Z.generateURLParams(l,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([e,t])=>{null!==t&&(this.has_filter=!0,l=ve.Z.generateURLParams(l,e,t))})),this.$api.get(l).then((a=>{const{data:l,message:i,status:s}=a.data;s?(1===this.pagination.page?this.schedules=[...l.list]:this.schedules=this.schedules.concat(l.list),this.pagination={...this.pagination,page:l.pagination.page,total_page:l.pagination.total_page},e()):t()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var Oe=a(9885),Ne=a(990),Be=a(7817),Ee=a(7661),Je=a(699),Ye=a(6870),Ke=a(2218),Ge=a(7501),Xe=a(854),et=a(1136);const tt=(0,qe.Z)(Me,[["render",ge],["__scopeId","data-v-3824e176"]]),at=tt;je()(Me,"components",{QPage:Oe.Z,QBtn:Qe.Z,QBadge:Ne.Z,QTabs:Be.Z,QTab:Ee.Z,QPullToRefresh:Je.Z,QInfiniteScroll:Ye.Z,QCard:We.Z,QCardSection:Ze.Z,QImg:Ve.Z,QSeparator:Ke.Z,QSpinnerDots:Ge.Z,QInnerLoading:Xe.Z,QIcon:Ce.Z}),je()(Me,"directives",{Ripple:et.Z})}}]);