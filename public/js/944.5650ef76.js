"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[944],{7682:(e,t,l)=>{l.d(t,{Z:()=>s});l(6727);var a=l(3701),i=l(9302);const{getScrollTarget:n,setVerticalScrollPosition:o}=a.ZP;(0,i.Z)();class s{static generateURLParams(e,t,l){return e.includes("?")?e+=`&${t}=${l}`:e+=`?${t}=${l}`,e}static scrollToElement(e,t=null){const l=n(e),a=null===t?e.offsetTop:t,i=500;o(l,a,i)}static loading(e,t=!0,l=null){t?e.$q.loading.show({message:null===l?"Loading ...":l}):e.$q.loading.hide()}}},8944:(e,t,l)=>{l.r(t),l.d(t,{default:()=>O});var a=l(9835),i=l(6970);const n=e=>((0,a.dD)("data-v-b336d8b2"),e=e(),(0,a.Cn)(),e),o={class:"page bg-accent",style:{"min-height":"inherit"}},s=n((()=>(0,a._)("div",{class:"text-center text-h5 text-white text-bold bg-secondary q-py-xl"}," Events ",-1))),r={class:""},d={class:"text-right bg-secondary q-pr-md q-pt-lg"},c={key:0,class:"flex flex-center q-py-xl",style:{gap:"40px"}},u={class:"card-event-container"},p={class:"flex items-center justify-between"},h={class:"text-body1 q-mt-sm"},m=n((()=>(0,a._)("hr",null,null,-1))),f={class:"text-description"},g={key:1,class:"text-center q-mt-xl text-body1"};function v(e,t,l,n,v,b){const w=(0,a.up)("q-badge"),_=(0,a.up)("q-btn"),y=(0,a.up)("q-tab"),Z=(0,a.up)("q-tabs"),q=(0,a.up)("q-card-section"),k=(0,a.up)("q-icon"),x=(0,a.up)("q-card"),W=(0,a.up)("q-infinite-scroll"),D=(0,a.up)("q-pull-to-refresh"),Q=(0,a.up)("event-filter"),C=(0,a.Q2)("ripple");return(0,a.wg)(),(0,a.iD)("div",o,[(0,a._)("div",null,[s,(0,a._)("div",r,[(0,a._)("div",d,[(0,a.Wm)(_,{label:"filter",icon:"filter_alt",unelevated:"",color:"primary",onClick:b.showFilterDialog},{default:(0,a.w5)((()=>[e.has_filter?((0,a.wg)(),(0,a.j4)(w,{key:0,floating:"",color:"white",rounded:""})):(0,a.kq)("",!0)])),_:1},8,["onClick"])]),(0,a.Wm)(Z,{modelValue:e.tab,"onUpdate:modelValue":[t[0]||(t[0]=t=>e.tab=t),t[1]||(t[1]=()=>b.getEvents(1))],"inline-label":"",ref:"tab",class:"bg-secondary text-primary","active-class":"text-white"},{default:(0,a.w5)((()=>[(0,a.Wm)(y,{name:"upcoming",label:"Upcoming"}),(0,a.Wm)(y,{name:"live",label:"Live"})])),_:1},8,["modelValue"]),(0,a.Wm)(D,{onRefresh:b.refresh,style:{"min-height":"200px"}},{default:(0,a.w5)((()=>[e.data.length>0?((0,a.wg)(),(0,a.iD)("div",c,[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(e.data,(e=>((0,a.wg)(),(0,a.iD)("div",{key:e.id},[(0,a.Wm)(W,{onLoad:b.loadMore},{default:(0,a.w5)((()=>[(0,a._)("div",u,[(0,a.wy)(((0,a.wg)(),(0,a.j4)(x,{class:"event-card",clickable:"",onClick:()=>b.openPage(e.id)},{default:(0,a.w5)((()=>[(0,a.Wm)(q,{class:"event-logo",style:(0,i.j5)({backgroundImage:`url('${e.image_link}')`})},null,8,["style"]),(0,a.Wm)(q,null,{default:(0,a.w5)((()=>[(0,a._)("div",p,[(0,a._)("div",null,[(0,a._)("small",null,[(0,a.Wm)(k,{name:"calendar_month"}),(0,a.Uk)(" "+(0,i.zw)(b.scheduleDate(e.start_date)),1)])])]),(0,a._)("div",h,[(0,a._)("b",null,(0,i.zw)(e.name),1)]),m,(0,a._)("div",f,(0,i.zw)(e.description),1)])),_:2},1024)])),_:2},1032,["onClick"])),[[C]])])])),_:2},1032,["onLoad"])])))),128))])):((0,a.wg)(),(0,a.iD)("div",g," No Data "))])),_:1},8,["onRefresh"]),(0,a.Wm)(Q,{show:e.filter.dialog,onHide:b.hideFilterDialog,onFilter:b.onFilter},null,8,["show","onHide","onFilter"])])])])}l(702);var b=l(7682),w=(l(9829),l(3878)),_=l.n(w);const y=(0,a._)("div",{class:"text-h6 text-primary"},"Filter",-1),Z={class:"row items-center justify-end"};function q(e,t,l,i,n,o){const s=(0,a.up)("q-card-section"),r=(0,a.up)("q-input"),d=(0,a.up)("q-btn"),c=(0,a.up)("q-date"),u=(0,a.up)("q-popup-proxy"),p=(0,a.up)("q-icon"),h=(0,a.up)("q-card-actions"),m=(0,a.up)("q-card"),f=(0,a.up)("q-dialog"),g=(0,a.Q2)("close-popup");return(0,a.wg)(),(0,a.iD)("div",null,[(0,a.Wm)(f,{modelValue:e.visible,"onUpdate:modelValue":t[3]||(t[3]=t=>e.visible=t),onHide:o.hide,position:"bottom"},{default:(0,a.w5)((()=>[(0,a.Wm)(m,{class:"card-bottom"},{default:(0,a.w5)((()=>[(0,a.Wm)(s,null,{default:(0,a.w5)((()=>[y])),_:1}),(0,a.Wm)(s,{class:"q-pt-none"},{default:(0,a.w5)((()=>[(0,a.Wm)(r,{modelValue:e.filter.name,"onUpdate:modelValue":t[0]||(t[0]=t=>e.filter.name=t),label:"Name"},null,8,["modelValue"]),(0,a.Wm)(r,{modelValue:e.filter.date,"onUpdate:modelValue":t[2]||(t[2]=t=>e.filter.date=t),mask:"date",label:"Date"},{append:(0,a.w5)((()=>[(0,a.Wm)(p,{name:"event",class:"cursor-pointer"},{default:(0,a.w5)((()=>[(0,a.Wm)(u,{cover:"","transition-show":"scale","transition-hide":"scale"},{default:(0,a.w5)((()=>[(0,a.Wm)(c,{modelValue:e.filter.date,"onUpdate:modelValue":t[1]||(t[1]=t=>e.filter.date=t)},{default:(0,a.w5)((()=>[(0,a._)("div",Z,[(0,a.wy)((0,a.Wm)(d,{label:"Close",color:"primary",flat:""},null,512),[[g]])])])),_:1},8,["modelValue"])])),_:1})])),_:1})])),_:1},8,["modelValue"])])),_:1}),(0,a.Wm)(h,{align:"right"},{default:(0,a.w5)((()=>[(0,a.Wm)(d,{flat:"",icon:"backspace",label:"Clear Filter",color:"primary",onClick:o.clearFilter},null,8,["onClick"]),(0,a.Wm)(d,{unelevated:"",icon:"filter_alt",label:"Filter",color:"primary",onClick:o.onFilter},null,8,["onClick"])])),_:1})])),_:1})])),_:1},8,["modelValue","onHide"])])}const k={name:null,date:null},x={props:{show:{type:Boolean,required:!0}},data:function(){return{visible:this.show,filter:{...k}}},watch:{show:function(e){this.visible=e,e||this.hide()}},methods:{clearFilter:function(){this.filter={...k},this.$emit("filter",this.filter),this.hide()},onFilter:function(){this.$emit("filter",this.filter),this.hide()},hide:function(){this.visible=!1,this.$emit("hide")}}};var W=l(1639),D=l(2074),Q=l(4458),C=l(3190),F=l(1852),V=l(2857),$=l(2765),P=l(7088),E=l(4455),U=l(1821),T=l(2146),M=l(9984),L=l.n(M);const R=(0,W.Z)(x,[["render",q]]),j=R;L()(x,"components",{QDialog:D.Z,QCard:Q.Z,QCardSection:C.Z,QInput:F.Z,QIcon:V.Z,QPopupProxy:$.Z,QDate:P.Z,QBtn:E.Z,QCardActions:U.Z}),L()(x,"directives",{ClosePopup:T.Z});var I=l(5457);const z={components:{EventFilter:j},data:function(){return{loading:!0,data:[],tab:"upcoming",has_filter:!1,schedules:[],pagination:{page:1,total_page:1},filter:{dialog:!1,data:{name:null,date:null}}}},mounted:function(){(0,I.Z)({title:"Event"}),this.getEvents()},methods:{scheduleDate:function(e){const t=_().utc(e).local().format("D MMMM Y");return t},scheduleTime:function(e){const t=_().utc(e).local().format("hh:mm"),l=_().tz.guess(),a=_().tz(l).zoneAbbr();return`${t} ${a}`},onFilter:async function(e){this.filter.data={...e},null!==this.filter.data.date&&(this.tab="all"),await this.getEvents(1),this.hideFilterDialog()},hideFilterDialog:function(){this.filter.dialog=!1},showFilterDialog:function(){this.filter.dialog=!0},loadMore:async function(e,t){const l=this.pagination.page;l<this.pagination.total_page&&(this.pagination.page=parseInt(l)+1,await this.getEvents()),t()},refresh:async function(e){await this.getEvents(1),e()},openPage:function(e){setTimeout((()=>{window.open(`${this.$host}/event-schedule/${e}`)}),300)},parseDate:function(e){const t=_()(e);return t.isValid()?t.format("ddd, DD MMM YYYY"):"-"},getEvents:function(e=null){return null!==e&&(this.pagination.page=e),b.Z.loading(this),new Promise((e=>{const t=this.pagination.page;let l="event/list";l=b.Z.generateURLParams(l,"page",t),l=b.Z.generateURLParams(l,"type",this.tab),this.has_filter=!1,Object.entries(this.filter.data).forEach((([e,t])=>{null!==t&&(this.has_filter=!0,l=b.Z.generateURLParams(l,e,t))})),this.$api.get(l).then((t=>{const{data:l,message:a,status:i}=t.data;i?(this.data=[...l.list],b.Z.loading(this,!1),e()):reject()}))}))}}};var Y=l(990),H=l(7817),S=l(7661),B=l(699),A=l(6870),N=l(1136);const K=(0,W.Z)(z,[["render",v],["__scopeId","data-v-b336d8b2"]]),O=K;L()(z,"components",{QBtn:E.Z,QBadge:Y.Z,QTabs:H.Z,QTab:S.Z,QPullToRefresh:B.Z,QInfiniteScroll:A.Z,QCard:Q.Z,QCardSection:C.Z,QIcon:V.Z}),L()(z,"directives",{Ripple:N.Z})}}]);