"use strict";(globalThis["webpackChunkhome_app"]=globalThis["webpackChunkhome_app"]||[]).push([[684],{7682:(e,t,a)=>{a.d(t,{Z:()=>n});a(6727);var s=a(3701),i=a(9302);const{getScrollTarget:l,setVerticalScrollPosition:o}=s.ZP;(0,i.Z)();class n{static generateURLParams(e,t,a){return e.includes("?")?e+=`&${t}=${a}`:e+=`?${t}=${a}`,e}static scrollToElement(e,t=null){const a=l(e),s=null===t?e.offsetTop:t,i=500;o(a,s,i)}static loading(e,t=!0,a=null){t?e.$q.loading.show({message:null===a?"Loading ...":a}):e.$q.loading.hide()}}},3684:(e,t,a)=>{a.r(t),a.d(t,{default:()=>S});var s=a(9835),i=a(6970);const l=e=>((0,s.dD)("data-v-723325cd"),e=e(),(0,s.Cn)(),e),o={class:"q-px-md q-py-xl page bg-accent",style:{"min-height":"inherit"}},n=l((()=>(0,s._)("div",{class:"text-center text-h5 text-primary text-bold"}," Movies ",-1))),r={class:"q-my-xl"},c={key:0,class:"flex flex-center",style:{gap:"40px"}},d={class:"card-movie-container"},g={class:"flex flex-center"},u=["src"],m={class:"text-center q-mt-lg"},p={class:"text-bold text-primary q-mt-md"},h={key:0},v={key:1},w={key:1,class:"text-center"};function f(e,t,a,l,f,x){const _=(0,s.up)("q-img"),$=(0,s.up)("q-card-section"),y=(0,s.up)("q-separator"),D=(0,s.up)("q-card"),k=(0,s.Q2)("ripple");return(0,s.wg)(),(0,s.iD)("div",o,[(0,s._)("div",null,[n,(0,s._)("div",r,[e.data.length>0?((0,s.wg)(),(0,s.iD)("div",c,[((0,s.wg)(!0),(0,s.iD)(s.HY,null,(0,s.Ko)(e.data,(t=>((0,s.wg)(),(0,s.iD)("div",{key:t.id},[(0,s._)("div",d,[(0,s.wy)(((0,s.wg)(),(0,s.j4)(D,{class:(0,i.C_)("movie-card "+(null===t.offer?"disabled":null)),onClick:e=>x.openDetailPage(t)},{default:(0,s.w5)((()=>[(0,s.Wm)($,null,{default:(0,s.w5)((()=>[(0,s._)("div",g,[null!==t.movie.image?((0,s.wg)(),(0,s.j4)(_,{key:0,class:"logo",src:`${e.$host}/storage/movie/image/${t.movie.image}`,ratio:1},{error:(0,s.w5)((()=>[(0,s._)("img",{src:`${e.$host}/images/no-logo-1.png`,style:{width:"100%",height:"100%"}},null,8,u)])),_:2},1032,["src"])):((0,s.wg)(),(0,s.j4)(_,{key:1,class:"logo",src:`${e.$host}/images/no-logo-1.png`,ratio:1},null,8,["src"]))]),(0,s._)("div",m,[(0,s._)("div",p,(0,i.zw)(t.movie.name),1)])])),_:2},1024),(0,s.Wm)(y),(0,s.Wm)($,{class:"text-center q-px-md bg-primary text-white"},{default:(0,s.w5)((()=>[null===t.release_date?((0,s.wg)(),(0,s.iD)("span",h," Coming Soon ")):((0,s.wg)(),(0,s.iD)("span",v,(0,i.zw)(x.parseDate(t.release_date)),1))])),_:2},1024)])),_:2},1032,["class","onClick"])),[[k]])])])))),128))])):((0,s.wg)(),(0,s.iD)("div",w," No schedule right now ... "))])])])}a(702);var x=a(7682),_=(a(9829),a(3878)),$=a.n(_),y=a(5457);const D={data:function(){return{loading:!0,data:[]}},mounted:function(){(0,y.Z)({title:"Movie"}),this.getMovies()},methods:{openDetailPage:function(e){if(null===e.offer)return!1;setTimeout((()=>{window.open(`${this.$host}/movie/schedule/${e.id}`)}),300)},parseDate:function(e){const t=$()(e);return t.isValid()?t.format("ddd, DD MMM YYYY"):"-"},getMovies:function(e){x.Z.loading(this);let t="movie/schedule/list";return t=x.Z.generateURLParams(t,"showall",!0),new Promise((e=>{this.$api.get(t).then((t=>{const{data:a,message:s,status:i}=t.data;i?(this.data=[...a.list],x.Z.loading(this,!1),e()):reject()}))}))}}};var k=a(1639),Z=a(4458),q=a(3190),b=a(335),C=a(2218),M=a(1136),P=a(9984),T=a.n(P);const Q=(0,k.Z)(D,[["render",f],["__scopeId","data-v-723325cd"]]),S=Q;T()(D,"components",{QCard:Z.Z,QCardSection:q.Z,QImg:b.Z,QSeparator:C.Z}),T()(D,"directives",{Ripple:M.Z})}}]);