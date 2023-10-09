import{b as h,u as f,t as v}from"./links.d8ef3c22.js";import{B as S}from"./Img.9752e9ac.js";import{C as w}from"./Caret.11ded1aa.js";import{S as y}from"./Book.22520912.js";import{S as C}from"./Profile.9886831c.js";import{r as a,o as i,c as b,a as e,d as c,t as r,n as I,C as k,b as d,f as l,K as B,O as x,e as N,g as A,M as O,N as P}from"./vue.runtime.esm-bundler.0bc3eabf.js";import{_ as T}from"./_plugin-vue_export-helper.8823f7c1.js";const V={setup(){return{optionsStore:h(),rootStore:f()}},components:{BaseImg:S,CoreLoader:w,SvgBook:y,SvgDannieProfile:C},props:{card:String,description:{type:String,required:!0},image:String,loading:{type:Boolean,default:!1},title:{type:String,required:!0}},data(){return{canShowImage:!1}},computed:{appName(){return"All in One SEO"},getCard(){return this.card==="default"?this.optionsStore.options.social.twitter.general.defaultCardType:this.card}},methods:{maybeCanShow(o){this.canShowImage=o},truncate:v}},D=o=>(O("data-v-4b78a9ed"),o=o(),P(),o),L={class:"aioseo-twitter-preview"},q={class:"twitter-post"},z={class:"twitter-header"},E={class:"profile-photo"},R={class:"poster"},K={class:"poster-name"},M=D(()=>e("div",{class:"poster-username"}," @aioseopack ",-1)),U={class:"twitter-content"},j={class:"twitter-site-description"},F={class:"site-domain"},G={class:"site-title"},H={class:"site-description"};function J(o,Q,t,_,n,s){const m=a("svg-dannie-profile"),u=a("svg-book"),p=a("core-loader"),g=a("base-img");return i(),b("div",L,[e("div",q,[e("div",z,[e("div",E,[c(m)]),e("div",R,[e("div",K,r(s.appName),1),M])]),e("div",{class:I(["twitter-container",t.image?s.getCard:"summary"])},[e("div",U,[e("div",{class:"twitter-image-preview",style:k({backgroundImage:s.getCard==="summary"&&n.canShowImage?`url('${t.image}')`:""})},[!t.loading&&(!t.image||!n.canShowImage)?(i(),d(u,{key:0})):l("",!0),t.loading?(i(),d(p,{key:1})):l("",!0),B(c(g,{src:t.image,debounce:!1,onCanShow:s.maybeCanShow},null,8,["src","onCanShow"]),[[x,s.getCard==="summary_large_image"&&n.canShowImage]])],4),e("div",j,[e("div",F,[N(o.$slots,"site-url",{},()=>[A(r(_.rootStore.aioseo.urls.domain),1)],!0)]),e("div",G,r(s.truncate(t.title,70)),1),e("div",H,r(s.truncate(t.description,105)),1)])])],2)])])}const oe=T(V,[["render",J],["__scopeId","data-v-4b78a9ed"]]);export{oe as C};
