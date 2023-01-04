"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[684],{7682:(t,e,l)=>{l.d(e,{Z:()=>n});l(6727);var i=l(3701),o=l(9302);const{getScrollTarget:a,setVerticalScrollPosition:s}=i.ZP;(0,o.Z)();class n{static generateURLParams(t,e,l){return t.includes("?")?t+=`&${e}=${l}`:t+=`?${e}=${l}`,t}static scrollToElement(t,e=null){const l=a(t),i=null===e?t.offsetTop:e,o=500;s(l,i,o)}static loading(t,e=!0,l=null){e?t.$q.loading.show({message:null===l?"Loading ...":l}):t.$q.loading.hide()}}},2684:(t,e,l)=>{l.r(e),l.d(e,{default:()=>ee});var i=l(9835),o=l(6970);const a=t=>((0,i.dD)("data-v-ebdd1b8c"),t=t(),(0,i.Cn)(),t),s={class:"text-right bg-secondary q-pr-md q-pt-lg"},n={class:"q-pt-xl page bg-accent"},r={key:0},c={class:"card-schedule-container"},d={class:"left"},h={class:"full-width text-center"},p=["src"],m={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},g={class:"right"},u={class:"full-width text-center"},f=["src"],w={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},_={key:0,class:"center"},b=["src"],y={class:"top-left"},v=(0,i.Uk)(" Live  "),x={key:0},k=(0,i.Uk)("  "),$={class:"capitalize"},q=(0,i.Uk)("  "),W={key:1,class:"top-right"},Z=["src"],S={class:"top",style:{top:"30%"}},D={class:"bottom",style:{bottom:"30%"}},C=a((()=>(0,i._)("div",{class:"bottom text-caption",style:{bottom:"2%","font-size":"0.6em","letter-spacing":"2px"}}," WWW.SCHSPORTS.COM ",-1))),z={key:0,class:"capitalize"},Q={key:1},U={key:2},L={key:3},P={class:"flex flex-center q-py-md"},V={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"},F={key:1},T={class:"q-py-xl page bg-accent"},I={key:0},R={class:"q-gutter-md flex"},j={class:"left"},H={class:"full-width text-center"},M=["src"],O={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},A={class:"right"},N={class:"full-width text-center"},B=["src"],E={class:"text-bold text-white text q-mt-xs text-center text-caption",style:{"line-height":"1"}},J={key:0,class:"center"},Y=["src"],K={class:"top-left"},G={key:0},X=(0,i.Uk)("  "),tt={class:"capitalize"},et=(0,i.Uk)("  "),lt={key:1,class:"top-right"},it=["src"],ot={class:"top",style:{top:"30%"}},at={class:"bottom",style:{bottom:"30%"}},st=a((()=>(0,i._)("div",{class:"bottom text-caption",style:{bottom:"2%","font-size":"0.6em","letter-spacing":"2px"}}," WWW.SCHSPORTS.COM ",-1))),nt={class:"flex items-center justify-between"},rt={class:"text-body1 q-mt-sm"},ct=a((()=>(0,i._)("hr",null,null,-1))),dt=["innerHTML"],ht={key:0,class:"flex items-center justify-center q-mt-md"},pt={key:1,class:"text-primary text-h6 text-bold flex flex-center q-my-lg"};function mt(t,e,l,a,mt,gt){const ut=(0,i.up)("q-badge"),ft=(0,i.up)("q-btn"),wt=(0,i.up)("q-tab"),_t=(0,i.up)("q-tabs"),bt=(0,i.up)("q-img"),yt=(0,i.up)("q-card-section"),vt=(0,i.up)("q-separator"),xt=(0,i.up)("q-card"),kt=(0,i.up)("q-spinner-dots"),$t=(0,i.up)("q-infinite-scroll"),qt=(0,i.up)("q-inner-loading"),Wt=(0,i.up)("q-pull-to-refresh"),Zt=(0,i.up)("q-icon"),St=(0,i.up)("match-filter"),Dt=(0,i.up)("q-page"),Ct=(0,i.Q2)("ripple");return(0,i.wg)(),(0,i.j4)(Dt,null,{default:(0,i.w5)((()=>[(0,i._)("div",s,[(0,i.Wm)(ft,{label:"filter",icon:"filter_alt",unelevated:"",color:"primary",onClick:t.showFilterDialog},{default:(0,i.w5)((()=>[t.has_filter?((0,i.wg)(),(0,i.j4)(ut,{key:0,floating:"",color:"white",rounded:""})):(0,i.kq)("",!0)])),_:1},8,["onClick"])]),(0,i.Wm)(_t,{modelValue:t.tab,"onUpdate:modelValue":[e[0]||(e[0]=e=>t.tab=e),e[1]||(e[1]=()=>t.getSchedule(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,i.w5)((()=>[(0,i.Wm)(wt,{name:"live",label:"Live"}),(0,i.Wm)(wt,{name:"upcoming",label:"Upcoming"}),(0,i.Wm)(wt,{name:"this-week",label:"This Week"}),(0,i.Wm)(wt,{name:"today",label:"Today"}),(0,i.Wm)(wt,{name:"tomorrow",label:"Tomorrow"}),(0,i.Wm)(wt,{name:"highlight",label:"Highlight"})])),_:1},8,["modelValue"]),"highlight"!==t.tab?((0,i.wg)(),(0,i.j4)(Wt,{key:0,onRefresh:t.refresh},{default:(0,i.w5)((()=>[(0,i._)("div",n,[t.schedules.length>0?((0,i.wg)(),(0,i.iD)("div",r,[(0,i.Wm)($t,{onLoad:t.loadMore},{loading:(0,i.w5)((()=>[(0,i._)("div",P,[(0,i.Wm)(kt,{color:"accent",size:"40px"})])])),default:(0,i.w5)((()=>[(0,i._)("div",c,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(t.schedules,(e=>(0,i.wy)(((0,i.wg)(),(0,i.j4)(xt,{key:e.id,class:"event-card",onClick:()=>t.redirect(e.id)},{default:(0,i.w5)((()=>[(0,i.Wm)(yt,{class:"q-py-lg schedule-team-logo",style:(0,o.j5)({backgroundImage:"linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('"+e.link_stream.image_link+"')",color:"white",textShadow:"-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"})},{default:(0,i.w5)((()=>[(0,i._)("div",d,[(0,i._)("div",h,[(0,i._)("div",null,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/school/logo/${e.school1.logo}`,ratio:1,width:"40%"},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,p)])),_:2},1032,["src"])]),(0,i._)("div",m,(0,o.zw)(e.school1.name),1)])]),(0,i._)("div",g,[(0,i._)("div",u,[(0,i._)("div",null,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/school/logo/${e.school2.logo}`,ratio:1,width:"40%"},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,f)])),_:2},1032,["src"])]),(0,i._)("div",w,(0,o.zw)(e.school2.name),1)])]),null!==t.logo?((0,i.wg)(),(0,i.iD)("div",_,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/app/image/${t.logo}`,ratio:1},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,b)])),_:1},8,["src"])])):(0,i.kq)("",!0),(0,i._)("div",y,[v,null!==e.team_type?((0,i.wg)(),(0,i.iD)("span",x,(0,o.zw)(e.team_type.name),1)):(0,i.kq)("",!0),k,(0,i._)("span",$,(0,o.zw)(e.team_gender),1),q,(0,i._)("span",null,(0,o.zw)(e.sport.name),1)]),null!==e.championship?((0,i.wg)(),(0,i.iD)("div",W,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/championship/image/${e.championship.image}`,ratio:1},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,Z)])),_:2},1032,["src"])])):(0,i.kq)("",!0),(0,i._)("div",S,(0,o.zw)(t.scheduleDate(e.datetime)),1),(0,i._)("div",D,(0,o.zw)(t.scheduleTime(e.datetime)),1),C])),_:2},1032,["style"]),(0,i.Wm)(vt),(0,i.Wm)(yt,{class:"text-justify q-px-md bg-secondary text-accent text-bold"},{default:(0,i.w5)((()=>[(0,i._)("span",null," Watch: "+(0,o.zw)(e.school1.name)+" vs "+(0,o.zw)(e.school2.name)+" - "+(0,o.zw)(t.scheduleTime(e.datetime))+" - "+(0,o.zw)(t.scheduleDate(e.datetime))+" - ",1),null!==e.team_gender?((0,i.wg)(),(0,i.iD)("span",z,(0,o.zw)(e.team_gender)+" ",1)):(0,i.kq)("",!0),null!==e.sport?((0,i.wg)(),(0,i.iD)("span",Q,(0,o.zw)(e.sport.name),1)):null!==e.sport_type?((0,i.wg)(),(0,i.iD)("span",U,(0,o.zw)(e.sport_type.name),1)):(0,i.kq)("",!0),null!==e.stadium?((0,i.wg)(),(0,i.iD)("span",L," - Live from "+(0,o.zw)(e.stadium.name),1)):(0,i.kq)("",!0)])),_:2},1024)])),_:2},1032,["onClick"])),[[Ct]]))),128))])])),_:1},8,["onLoad"])])):((0,i.wg)(),(0,i.iD)("div",V," No Upcoming Events ")),(0,i.Wm)(qt,{showing:t.loadingSchedule,label:"Please wait...","label-class":"text-primary","label-style":"font-size: 1.1em"},null,8,["showing"])])])),_:1},8,["onRefresh"])):(0,i.kq)("",!0),"highlight"===t.tab?((0,i.wg)(),(0,i.iD)("div",F,[(0,i._)("div",T,[t.videos.length>0?((0,i.wg)(),(0,i.iD)("div",I,[(0,i._)("div",R,[((0,i.wg)(!0),(0,i.iD)(i.HY,null,(0,i.Ko)(t.videos,(e=>((0,i.wg)(),(0,i.j4)(xt,{key:e.id,class:"bg-white q-pa-md event-card",bordered:"",onClick:()=>t.toDetail(e.id)},{default:(0,i.w5)((()=>[(0,i.Wm)(yt,{class:"q-py-lg schedule-team-logo",style:(0,o.j5)({backgroundImage:"linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('"+e.link_stream.image_link+"')",color:"white",textShadow:"-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black"})},{default:(0,i.w5)((()=>[(0,i._)("div",j,[(0,i._)("div",H,[(0,i._)("div",null,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/school/logo/${e.school1.logo}`,ratio:1,width:"40%"},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,M)])),_:2},1032,["src"])]),(0,i._)("div",O,(0,o.zw)(e.school1.name),1)])]),(0,i._)("div",A,[(0,i._)("div",N,[(0,i._)("div",null,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/school/logo/${e.school2.logo}`,ratio:1,width:"40%"},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,B)])),_:2},1032,["src"])]),(0,i._)("div",E,(0,o.zw)(e.school2.name),1)])]),null!==t.logo?((0,i.wg)(),(0,i.iD)("div",J,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/app/image/${t.logo}`,ratio:1},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,Y)])),_:1},8,["src"])])):(0,i.kq)("",!0),(0,i._)("div",K,[null!==e.team_type?((0,i.wg)(),(0,i.iD)("span",G,(0,o.zw)(e.team_type.name),1)):(0,i.kq)("",!0),X,(0,i._)("span",tt,(0,o.zw)(e.team_gender),1),et,(0,i._)("span",null,(0,o.zw)(e.sport.name),1)]),null!==e.championship?((0,i.wg)(),(0,i.iD)("div",lt,[(0,i.Wm)(bt,{class:"logo",src:`${t.$host}/storage/championship/image/${e.championship.image}`,ratio:1},{error:(0,i.w5)((()=>[(0,i._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,it)])),_:2},1032,["src"])])):(0,i.kq)("",!0),(0,i._)("div",ot,(0,o.zw)(t.scheduleDate(e.datetime)),1),(0,i._)("div",at,(0,o.zw)(t.scheduleTime(e.datetime)),1),st])),_:2},1032,["style"]),(0,i.Wm)(vt),(0,i.Wm)(yt,{class:"text-justify q-px-md"},{default:(0,i.w5)((()=>[(0,i._)("div",nt,[(0,i._)("div",null,[(0,i._)("small",null,[(0,i.Wm)(Zt,{name:"calendar_month"}),(0,i.Uk)(" "+(0,o.zw)(t.scheduleDate(e.datetime)),1)])]),(0,i._)("div",null,[(0,i._)("small",null,[(0,i.Wm)(Zt,{name:"schedule"}),(0,i.Uk)(" "+(0,o.zw)(t.scheduleTime(e.datetime)),1)])])]),(0,i._)("div",rt," Watch: "+(0,o.zw)(e.school1.name)+" vs "+(0,o.zw)(e.school2.name),1),ct,(0,i._)("div",{class:"text-description",innerHTML:e.description},null,8,dt)])),_:2},1024)])),_:2},1032,["onClick"])))),128))]),t.pagination_video.page<t.pagination_video.total_page?((0,i.wg)(),(0,i.iD)("div",ht,[(0,i.Wm)(ft,{class:"",label:"See More",color:"primary",onClick:t.nextVideoPage},null,8,["onClick"])])):(0,i.kq)("",!0)])):((0,i.wg)(),(0,i.iD)("div",pt," No Data Available "))])])):(0,i.kq)("",!0),(0,i.Wm)(St,{show:t.filter.dialog,onHide:t.hideFilterDialog,onFilter:t.onFilter},null,8,["show","onHide","onFilter"])])),_:1})}l(4110),l(702),l(9829);var gt=l(3878),ut=l.n(gt),ft=l(5457);const wt=(0,i._)("div",{class:"text-h6 text-primary"},"Filter",-1),_t={class:"row items-center justify-end"};function bt(t,e,l,a,s,n){const r=(0,i.up)("q-card-section"),c=(0,i.up)("q-btn"),d=(0,i.up)("q-date"),h=(0,i.up)("q-popup-proxy"),p=(0,i.up)("q-icon"),m=(0,i.up)("q-input"),g=(0,i.up)("q-select"),u=(0,i.up)("q-img"),f=(0,i.up)("q-item-section"),w=(0,i.up)("q-item-label"),_=(0,i.up)("q-item"),b=(0,i.up)("q-card-actions"),y=(0,i.up)("q-card"),v=(0,i.up)("q-dialog"),x=(0,i.Q2)("close-popup");return(0,i.wg)(),(0,i.iD)("div",null,[(0,i.Wm)(v,{modelValue:t.visible,"onUpdate:modelValue":e[5]||(e[5]=e=>t.visible=e),onHide:n.hide,position:"bottom"},{default:(0,i.w5)((()=>[(0,i.Wm)(y,{class:"card-bottom"},{default:(0,i.w5)((()=>[(0,i.Wm)(r,null,{default:(0,i.w5)((()=>[wt])),_:1}),(0,i.Wm)(r,{class:"q-pt-none"},{default:(0,i.w5)((()=>[(0,i.Wm)(m,{modelValue:t.filter.date,"onUpdate:modelValue":e[1]||(e[1]=e=>t.filter.date=e),mask:"date",readonly:"",label:"Date"},{append:(0,i.w5)((()=>[(0,i.Wm)(p,{name:"event",class:"cursor-pointer"},{default:(0,i.w5)((()=>[(0,i.Wm)(h,{cover:"","transition-show":"scale","transition-hide":"scale"},{default:(0,i.w5)((()=>[(0,i.Wm)(d,{modelValue:t.filter.date,"onUpdate:modelValue":e[0]||(e[0]=e=>t.filter.date=e)},{default:(0,i.w5)((()=>[(0,i._)("div",_t,[(0,i.wy)((0,i.Wm)(c,{label:"Close",color:"primary",flat:""},null,512),[[x]])])])),_:1},8,["modelValue"])])),_:1})])),_:1})])),_:1},8,["modelValue"]),(0,i.Wm)(g,{"use-input":"","map-options":"","emit-value":"",label:"Champions","input-debounce":"0",modelValue:t.filter.champion_id,"onUpdate:modelValue":e[2]||(e[2]=e=>t.filter.champion_id=e),options:t.options.champions,onFilter:n.filterChampions},null,8,["modelValue","options","onFilter"]),(0,i.Wm)(g,{"use-input":"","map-options":"","emit-value":"",label:"Sport","input-debounce":"0",modelValue:t.filter.sport_id,"onUpdate:modelValue":e[3]||(e[3]=e=>t.filter.sport_id=e),options:t.options.sports,onFilter:n.filterSport},null,8,["modelValue","options","onFilter"]),(0,i.Wm)(g,{"use-input":"","map-options":"","emit-value":"",label:"School","input-debounce":"0",modelValue:t.filter.school_id,"onUpdate:modelValue":e[4]||(e[4]=e=>t.filter.school_id=e),options:t.options.schools,onFilter:n.filterSchool},{option:(0,i.w5)((t=>[(0,i.Wm)(_,(0,o.vs)((0,i.F4)(t.itemProps)),{default:(0,i.w5)((()=>[(0,i.Wm)(f,{avatar:""},{default:(0,i.w5)((()=>[(0,i.Wm)(u,{src:t.opt.icon},null,8,["src"])])),_:2},1024),(0,i.Wm)(f,null,{default:(0,i.w5)((()=>[(0,i.Wm)(w,null,{default:(0,i.w5)((()=>[(0,i.Uk)((0,o.zw)(t.opt.label),1)])),_:2},1024)])),_:2},1024)])),_:2},1040)])),_:1},8,["modelValue","options","onFilter"])])),_:1}),(0,i.Wm)(b,{align:"right"},{default:(0,i.w5)((()=>[(0,i.Wm)(c,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:n.clearFilter},null,8,["onClick"]),(0,i.Wm)(c,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:n.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}var yt=l(7682);const vt={school_id:null,champion_id:null,sport_id:null,date:null},xt={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...vt},options:{schools:[],champions:[],sports:[]},master:{schools:[],champions:[],sports:[]}}},watch:{show:function(t){this.visible=t,t||this.hide()}},mounted:function(){this.getSchools(),this.getChampions(),this.getSports()},methods:{clearFilter:function(){this.filter={...vt},this.$emit("filter",this.filter),this.hide()},filterSchool:function(t,e){e((()=>{const e=t.toLowerCase();this.options.schools=this.master.schools.filter((t=>t.label.toLowerCase().indexOf(e)>-1))}))},filterChampions:function(t,e){e((()=>{const e=t.toLowerCase();this.options.champions=this.master.champions.filter((t=>t.label.toLowerCase().indexOf(e)>-1))}))},filterSport:function(t,e){e((()=>{const e=t.toLowerCase();this.options.sports=this.master.sports.filter((t=>t.label.toLowerCase().indexOf(e)>-1))}))},getSchools:function(t=null){yt.Z.loading(this),this.options.schools=[],this.master.schools=[],window.localStorage.removeItem("masterdata_schools");let e="school/list";e=yt.Z.generateURLParams(e,"showall",!0),this.$api.get(e).then((t=>{const{data:e,message:l,status:i}=t.data;if(i){const t=[];e.list.map((e=>{t.push({label:e.name,value:e.id,icon:`${this.$host}/storage/school/logo/${e.logo}`})})),this.options.schools=[...t],this.master.schools=[...t],window.localStorage.setItem("masterdata_schools",JSON.stringify(t))}})).finally((()=>{this.filter.school_id="undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,yt.Z.loading(this,!1)}))},getSports:function(t=null){this.options.sports=[],this.master.sports=[],window.localStorage.removeItem("masterdata_sports"),yt.Z.loading(this);let e="sport/list";e=yt.Z.generateURLParams(e,"showall",!0),null!==t&&(e=yt.Z.generateURLParams(e,"champion_id",t)),this.$api.get(e).then((t=>{const{data:e,message:l,status:i}=t.data;if(i){const t=[];e.list.map((e=>{t.push({label:e.name,value:e.id})})),this.options.sports=[...t],this.master.sports=[...t],window.localStorage.setItem("masterdata_sports",JSON.stringify(t))}})).finally((()=>{yt.Z.loading(this,!1)}))},getChampions:function(){this.options.champions=[],this.master.champions=[],window.localStorage.removeItem("masterdata_champions"),yt.Z.loading(this);let t="championship/list";t=yt.Z.generateURLParams(t,"showall",!0),this.$api.get(t).then((t=>{const{data:e,message:l,status:i}=t.data;if(i){const t=[];e.list.map((e=>{t.push({label:e.abbreviation,value:e.id})})),this.options.champions=[...t],this.master.champions=[...t],window.localStorage.setItem("masterdata_champions",JSON.stringify(t))}})).finally((()=>{yt.Z.loading(this,!1)}))},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var kt=l(1639),$t=l(2074),qt=l(4458),Wt=l(3190),Zt=l(1852),St=l(2857),Dt=l(2765),Ct=l(7088),zt=l(4455),Qt=l(8379),Ut=l(490),Lt=l(1233),Pt=l(335),Vt=l(3115),Ft=l(1821),Tt=l(2146),It=l(9984),Rt=l.n(It);const jt=(0,kt.Z)(xt,[["render",bt]]),Ht=jt;Rt()(xt,"components",{QDialog:$t.Z,QCard:qt.Z,QCardSection:Wt.Z,QInput:Zt.Z,QIcon:St.Z,QPopupProxy:Dt.Z,QDate:Ct.Z,QBtn:zt.Z,QSelect:Qt.Z,QItem:Ut.Z,QItemSection:Lt.Z,QImg:Pt.Z,QItemLabel:Vt.Z,QCardActions:Ft.Z}),Rt()(xt,"directives",{ClosePopup:Tt.Z});const Mt=(0,i.aZ)({name:"IndexPage",components:{MatchFilter:Ht},data:function(){return{logo:null,title:null,slide:0,banners:[],videos:[],filter:{dialog:!1,data:{school_id:"undefined"!==typeof this.$route.query.school_id?this.$route.query.school_id:null,champion_id:null,sport_id:null,date:null}},loadingSchedule:!1,tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1},pagination_video:{page:1,total_page:1}}},mounted:function(){this.getAppData();const t=this.$route.query.tab;"undefined"!==typeof t&&(this.tab=t,yt.Z.scrollToElement(this.$refs.tab.$el)),null!==this.filter.data.school_id?(this.filter.data.school_id=this.filter.data.school_id,this.onFilter(this.filter.data)):this.getSchedule(),(0,ft.Z)({title:"Home"})},watch:{tab:function(t){"highlight"===t&&this.getVideo()}},methods:{nextVideoPage:function(){this.pagination_video.page++,this.getVideo()},getVideo:function(t="have-played"){return yt.Z.loading(this),new Promise(((e,l)=>{const i=this.pagination_video.page;let o="match-schedule/list";o=yt.Z.generateURLParams(o,"page",i),o=yt.Z.generateURLParams(o,"limit",10),o=yt.Z.generateURLParams(o,"type",t),this.$api.get(o).then((t=>{const{data:i,message:o,status:a}=t.data;if(a){const t=[...this.videos];this.videos=[...t,...i.list],this.pagination_video={page:i.pagination.page,total_page:i.pagination.total_page},e()}else l()})).finally((()=>{yt.Z.loading(this,!1)}))}))},onFilter:async function(t){this.filter.data={...t},null!==this.filter.data.date&&(this.tab=null),await this.getSchedule(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(t,e){const l=this.pagination.page;l<this.pagination.total_page&&(this.pagination.page=parseInt(l)+1,await this.getSchedule()),e()},redirect:function(t){setTimeout((()=>{window.open(`${this.$host}/schedule/${t}`)}),300)},refresh:async function(t){await this.getSchedule(1),t()},scheduleDate:function(t){const e=ut().utc(t).local().format("D MMMM Y");return e},scheduleTime:function(t){const e=ut().utc(t).local().format("hh:mm"),l=ut().tz.guess(),i=ut().tz(l).zoneAbbr();return`${e} ${i}`},getAppData:function(){this.$api.get("app/detail").then((t=>{const{data:e,message:l,status:i}=t.data;this.title=e.name,this.logo=e.logo}))},getSchedule:function(t=null){return null!==t&&(this.pagination.page=t),this.loadingSchedule=!0,new Promise(((t,e)=>{const l=this.pagination.page;let i="match-schedule/list";i=yt.Z.generateURLParams(i,"page",l),i=yt.Z.generateURLParams(i,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([t,e])=>{null!==e&&(this.has_filter=!0,i=yt.Z.generateURLParams(i,t,e))})),this.$api.get(i).then((l=>{const{data:i,message:o,status:a}=l.data;a?(1===this.pagination.page?this.schedules=[...i.list]:this.schedules=this.schedules.concat(i.list),this.pagination={...this.pagination,page:i.pagination.page,total_page:i.pagination.total_page},t()):e()})).finally((()=>{this.loadingSchedule=!1}))}))}}});var Ot=l(9885),At=l(990),Nt=l(7817),Bt=l(7661),Et=l(699),Jt=l(6870),Yt=l(2218),Kt=l(7501),Gt=l(854),Xt=l(1136);const te=(0,kt.Z)(Mt,[["render",mt],["__scopeId","data-v-ebdd1b8c"]]),ee=te;Rt()(Mt,"components",{QPage:Ot.Z,QBtn:zt.Z,QBadge:At.Z,QTabs:Nt.Z,QTab:Bt.Z,QPullToRefresh:Et.Z,QInfiniteScroll:Jt.Z,QCard:qt.Z,QCardSection:Wt.Z,QImg:Pt.Z,QSeparator:Yt.Z,QSpinnerDots:Kt.Z,QInnerLoading:Gt.Z,QIcon:St.Z}),Rt()(Mt,"directives",{Ripple:Xt.Z})}}]);