"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[480],{7682:(t,e,o)=>{o.d(e,{Z:()=>n});o(6727);var a=o(3701);const{getScrollTarget:l,setVerticalScrollPosition:s}=a.ZP;class n{static generateURLParams(t,e,o){return t.includes("?")?t+=`&${e}=${o}`:t+=`?${e}=${o}`,t}static scrollToElement(t,e=null){const o=l(t),a=null===e?t.offsetTop:e,n=500;s(o,a,n)}}},9480:(t,e,o)=>{o.r(e),o.d(e,{default:()=>P});var a=o(9835),l=o(6970);const s=t=>((0,a.dD)("data-v-c1fdebaa"),t=t(),(0,a.Cn)(),t),n={class:"q-px-xl page list-container bg-grey-1 shadow-1"},i=s((()=>(0,a._)("div",{class:"text-center text-h5 text-primary text-bold q-mt-xl"}," Latest Post ",-1))),c={class:"q-mt-xl",ref:"post"},g={key:0,class:"card q-gutter-lg row"},r=s((()=>(0,a._)("div",{class:"text-primary text-bold"},"Football",-1))),d={class:"column flex items-center"},p=["src"],u=s((()=>(0,a._)("div",{class:"text-body1 text-grey-7 flex flex-center q-px-lg"}," VS ",-1))),h={class:"column flex items-center"},m=["src"],w={key:1,class:"text-primary text-bold"};function _(t,e,o,s,_,f){const x=(0,a.up)("q-section"),v=(0,a.up)("q-img"),$=(0,a.up)("q-card"),b=(0,a.up)("q-pagination"),y=(0,a.Q2)("ripple");return(0,a.wg)(),(0,a.iD)("div",n,[i,(0,a._)("div",c,[t.news.length>0?((0,a.wg)(),(0,a.iD)("div",g,[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(t.news,(e=>(0,a.wy)(((0,a.wg)(),(0,a.j4)($,{key:e.id,class:"col-12 q-pa-md news-card",bordered:"",onClick:()=>f.toDetail(e.id)},{default:(0,a.w5)((()=>[(0,a.Wm)(x,{class:""},{default:(0,a.w5)((()=>[r])),_:1}),(0,a.Wm)(x,{class:"club-container"},{default:(0,a.w5)((()=>[(0,a._)("div",d,[null!==e.school1.logo?((0,a.wg)(),(0,a.j4)(v,{key:0,class:"logo",src:`${t.$host}/storage/school/logo/${e.school1.logo}`,ratio:1},{error:(0,a.w5)((()=>[(0,a._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,p)])),_:2},1032,["src"])):((0,a.wg)(),(0,a.j4)(v,{key:1,class:"logo",src:`${t.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,a._)("div",null,(0,l.zw)(e.school1.name)+" ("+(0,l.zw)(e.school1.county.abbreviation)+")",1)]),u,(0,a._)("div",h,[null!==e.school2.logo?((0,a.wg)(),(0,a.j4)(v,{key:0,class:"logo",src:`${t.$host}/storage/school/logo/${e.school2.logo}`,ratio:1},{error:(0,a.w5)((()=>[(0,a._)("img",{src:`${t.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,m)])),_:2},1032,["src"])):((0,a.wg)(),(0,a.j4)(v,{key:1,class:"logo",src:`${t.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"])),(0,a._)("div",null,(0,l.zw)(e.school2.name)+" ("+(0,l.zw)(e.school2.county.abbreviation)+")",1)])])),_:2},1024)])),_:2},1032,["onClick"])),[[y]]))),128))])):((0,a.wg)(),(0,a.iD)("div",w," No Data Available ")),t.pagination.total_page>1?((0,a.wg)(),(0,a.j4)(b,{key:2,class:"flex flex-center q-mt-lg",modelValue:t.pagination.page,"onUpdate:modelValue":[e[0]||(e[0]=e=>t.pagination.page=e),f.getNews],max:t.pagination.total_page,input:""},null,8,["modelValue","max","onUpdate:modelValue"])):(0,a.kq)("",!0)],512)])}o(4110),o(702);var f=o(7682);const x={data:function(){return{search:null,tab:"live",news:[],pagination:{page:1,total_page:1}}},mounted:function(){this.getNews()},methods:{toDetail:function(t){setTimeout((()=>{this.$router.push({name:"news.detail",params:{id:t}})}),500)},getNews:function(){return this.loadingSchedule=!0,new Promise(((t,e)=>{const o=this.pagination.page;let a="match-schedule/news/list";a=f.Z.generateURLParams(a,"page",o),this.$api.get(a).then((o=>{const{data:a,message:l,status:s}=o.data;if(s){this.news=[...a.list],this.pagination={...this.pagination,page:a.pagination.page,total_page:a.pagination.total_page};const e=this.$refs.post;f.Z.scrollToElement(e,-100),t()}else e()})).finally((()=>{this.loadingSchedule=!1}))}))}}};var v=o(1639),$=o(4458),b=o(335),y=o(3044),k=o(1136),q=o(9984),Z=o.n(q);const D=(0,v.Z)(x,[["render",_],["__scopeId","data-v-c1fdebaa"]]),P=D;Z()(x,"components",{QCard:$.Z,QImg:b.Z,QPagination:y.Z}),Z()(x,"directives",{Ripple:k.Z})}}]);