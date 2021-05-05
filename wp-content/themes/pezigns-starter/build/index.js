!function(e){var t={};function n(a){if(t[a])return t[a].exports;var l=t[a]={i:a,l:!1,exports:{}};return e[a].call(l.exports,l,l.exports,n),l.l=!0,l.exports}n.m=e,n.c=t,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)n.d(a,l,function(t){return e[t]}.bind(null,l));return a},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=5)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.blockEditor},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.blocks},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,n){"use strict";n.r(t);var a=n(4),l=n.n(a),c=n(0),o=n(3),r=n(2),i=n(1);wp.domReady((function(){Object(o.unregisterBlockStyle)("core/button","fill"),Object(o.unregisterBlockStyle)("core/button","outline"),Object(o.unregisterBlockStyle)("core/button","default"),Object(o.unregisterBlockStyle)("core/button","squared"),Object(o.registerBlockStyle)("core/button",[{name:"theme-style",label:"Theme Style",isDefault:!0},{name:"default",label:"No Style"}])}));var m=n(6);Object(o.registerBlockType)("pezigns-starter/mega-block",{title:"Pezigns Mega Block",description:"This block can be used to create a custom anything",icon:"format-image",category:"text",attributes:{title:{type:"string",source:"html",selector:"h2"},titleColor:{type:"string",default:"white"},bodyColor:{type:"string",default:"white"},body:{type:"string",source:"html",selector:"p"},alignment:{type:"string",default:"center"},paddingTop:{type:"number",default:0},paddingRight:{type:"number",default:0},paddingBottom:{type:"number",default:0},paddingLeft:{type:"number",default:0},verticalAlignment:{type:"string",default:"center"},backgroundImage:{type:"string",default:""},overlayColor:{type:"string",default:"black"},overlayOpacity:{type:"number",default:0},isFullScreen:{type:"boolean",default:0},minWidth:{type:"string",default:"none"},minHeight:{type:"string",default:"none"},overflow:{type:"string",default:"visible"}},supports:{align:!0},edit:function(e){var t=e.attributes,n=(e.className,e.setAttributes),a=e.bgImage,o=t.backgroundImage,s=t.overlayColor,u=t.alignment,d=t.paddingTop,g=t.paddingRight,p=t.paddingBottom,b=t.paddingLeft,y=t.verticalAlignment,v=t.overlayOpacity,O=t.isFullScreen,f=t.minHeight,j=t.minWidth;function h(e){n({backgroundImage:e.sizes.large.url})}return t.overflow,m("mega-block-inner",l()({},"is-vertically-aligned-".concat(y),y)),Object(c.createElement)(React.Fragment,null,Object(c.createElement)(i.InspectorControls,{style:{marginBottom:"40px"}},Object(c.createElement)(r.PanelBody,{title:"Background Image Settings"},Object(c.createElement)("p",null,"Select a Background Image:"),Object(c.createElement)(i.MediaUploadCheck,null,Object(c.createElement)(i.MediaUpload,{key:"upload",onSelect:h,type:"image",value:o,render:function(e){var t=e.open;return Object(c.createElement)(React.Fragment,null,Object(c.createElement)("img",{src:o,onClick:t}),Object(c.createElement)(r.Button,{className:"editor-media-placeholder__button is-button is-default is-large",icon:"upload",onClick:t},"Select Background Image"))}})),!!o&&a&&Object(c.createElement)(i.MediaUploadCheck,null,Object(c.createElement)(i.MediaUpload,{key:"upload",onSelect:h,type:"image",value:o,render:function(e){var t=e.open;return Object(c.createElement)(React.Fragment,null,Object(c.createElement)("img",{src:o,onClick:t}),Object(c.createElement)(r.Button,{className:"editor-media-placeholder__button is-button is-default is-large",icon:"upload",onClick:t},"Replace Background Image"))}})),!!o&&Object(c.createElement)(i.MediaUploadCheck,null,Object(c.createElement)(r.Button,{onClick:function(){n({backgroundImage:{type:"string",default:""}})},isLink:!0,isDestructive:!0},"Remove Background Image"))),Object(c.createElement)(r.PanelBody,{title:"Overlay Settings"},Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)("p",null,"Overlay Color:"),Object(c.createElement)(i.ColorPalette,{key:"overlay-color",value:s,onChange:function(e){n({overlayColor:e})}})),Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.RangeControl,{key:"overlay-opacity",label:"Overlay Opacity:",value:v,onChange:function(e){n({overlayOpacity:e})},min:0,max:1,step:.01}))),Object(c.createElement)(r.PanelBody,{title:"Padding Settings"},Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.RangeControl,{key:"container-padding-top",label:"Padding Top:",value:d,onChange:function(e){n({paddingTop:e})},min:0,max:100,step:1})),Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.RangeControl,{key:"container-padding-right",label:"Padding Right:",value:g,onChange:function(e){n({paddingRight:e})},min:0,max:100,step:1})),Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.RangeControl,{key:"container-padding-bottom",label:"Padding Bottom:",value:p,onChange:function(e){n({paddingBottom:e})},min:0,max:100,step:1})),Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.RangeControl,{key:"container-padding-left",label:"Padding Left:",value:b,onChange:function(e){n({paddingLeft:e})},min:0,max:100,step:1}))),Object(c.createElement)(r.PanelBody,{title:"Full Screen Setting"},Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.CheckboxControl,{label:"Fullscreen Mega Block",help:"This sets the minimum height if the block to fullscreen",checked:O,onChange:function(e){n({isFullScreen:e}),0==O?(n({minHeight:"100vh"}),n({minWidth:"100vw"})):(n({overflow:"hidden"}),n({minHeight:"none"}),n({minWidth:"none"}))}})))),Object(c.createElement)("div",{className:"mega-block-container",style:{backgroundImage:"url('".concat(o,"')"),backgroundSize:"cover",backgroundPosition:"center center",backgroundRepeat:"no-repeat",textAlign:u,paddingTop:"".concat(d,"%"),paddingRight:"".concat(g,"%"),paddingBottom:"".concat(p,"%"),paddingLeft:"".concat(b,"%"),verticalAlign:y,minHeight:f,minWidth:j}},Object(c.createElement)("div",{className:"mega-block-overlay",style:{background:s,opacity:v,minHeight:f,minWidth:j,height:"100%",width:"100%"}}),Object(c.createElement)(i.BlockControls,null,Object(c.createElement)(i.AlignmentToolbar,{value:u,onChange:function(e){n({alignment:e})}}),Object(c.createElement)(i.BlockVerticalAlignmentToolbar,{onChange:function(e){n({verticalAlignment:e})},value:y})),Object(c.createElement)(i.InnerBlocks,null)))},save:function(e){var t=e.attributes,n=t.alignment,a=t.paddingTop,l=t.paddingRight,o=t.paddingBottom,r=t.paddingLeft,m=t.backgroundImage,s=t.overlayColor,u=t.overlayOpacity,d=t.verticalAlignment,g=t.minHeight,p=t.minWidth;return Object(c.createElement)("div",{className:"mega-block-container",style:{backgroundImage:"url('".concat(m,"')"),backgroundSize:"cover",backgroundPosition:"center center",backgroundRepeat:"no-repeat",textAlign:n,paddingTop:"".concat(a,"% !important"),paddingRight:"".concat(l,"% !important"),paddingBottom:"".concat(o,"% !important"),paddingLeft:"".concat(r,"% !important"),verticalAlign:d,minHeight:g,minWidth:p}},Object(c.createElement)("div",{className:"mega-block-overlay",style:{background:s,opacity:u,minHeight:g,minWidth:p,height:"100%",width:"100%"}}),Object(c.createElement)("div",{className:"mega-block-inner",style:{textAlign:n,verticalAlign:d,minHeight:g,minWidth:p}},Object(c.createElement)(i.InnerBlocks.Content,null)))}}),Object(o.registerBlockType)("pezigns-starter/count-down-block",{title:"Pezigns Count Down Block",description:"This block can be used to create a count down timer anything",icon:"format-image",category:"text",attributes:{countDownDate:{type:"string"},title:{type:"string",source:"html",selector:"h2"},titleColor:{type:"string",default:"white"},bodyColor:{type:"string",default:"white"},body:{type:"string",source:"html",selector:"p"},alignment:{type:"string",default:"center"},verticalAlignment:{type:"string",default:"center"},backgroundImage:{type:"string"},overlayColor:{type:"string",default:"black"},overlayOpacity:{type:"number",default:.6}},supports:{align:!0},edit:function(e){var t=e.attributes,n=(e.className,e.setAttributes),a=t.backgroundImage,o=t.overlayColor,s=t.alignment,u=t.verticalAlignment,d=t.overlayOpacity,g=t.countDownDate;return m("count-down-inner",l()({},"is-vertically-aligned-".concat(u),u)),Object(c.createElement)(React.Fragment,null,Object(c.createElement)(i.InspectorControls,{style:{marginBottom:"40px"}},Object(c.createElement)(r.PanelBody,{title:"Background Image Settings"},Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)("p",null,"Overlay Color:"),Object(c.createElement)(i.ColorPalette,{key:"overlay-color",value:o,onChange:function(e){n({overlayColor:e})}})),Object(c.createElement)("div",{style:{marginTop:"20px",marginBottom:"40px"}},Object(c.createElement)(r.RangeControl,{key:"overlay-opacity",label:"Overlay Opacity:",value:d,onChange:function(e){n({overlayOpacity:e})},min:0,max:1,step:.01})))),Object(c.createElement)("div",{className:"count-down-container",style:{backgroundImage:"url(".concat(a,")"),backgroundSize:"cover",backgroundPosition:"center",backgroundRepeat:"no-repeat",textAlign:s}},Object(c.createElement)("div",{className:"count-down-overlay",style:{background:o,opacity:d}}),Object(c.createElement)(i.BlockControls,null,Object(c.createElement)(i.AlignmentToolbar,{value:s,onChange:function(e){n({alignment:e})}}),Object(c.createElement)(i.BlockVerticalAlignmentToolbar,{onChange:function(e){n({verticalAlignment:e})},value:u})),Object(c.createElement)(i.RichText,{value:g,onChange:function(e){n({countDownDate:e})}}),Object(c.createElement)("div",{id:"clockdiv"},Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"days"}),Object(c.createElement)("div",{className:"smalltext"},"Days")),Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"hours"}),Object(c.createElement)("div",{className:"smalltext"},"Hours")),Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"minutes"}),Object(c.createElement)("div",{className:"smalltext"},"Minutes")),Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"seconds"}),Object(c.createElement)("div",{className:"smalltext"},"Seconds"))),Object(c.createElement)(i.InnerBlocks,null)))},save:function(e){var t=e.attributes,n=t.alignment,a=(t.backgroundImage,t.overlayColor),l=t.overlayOpacity;return Object(c.createElement)("div",{className:"count-down-container"},Object(c.createElement)("div",{className:"count-down-overlay",style:{background:a,opacity:l}}),Object(c.createElement)("div",{className:"count-down-inner",style:{textAlign:n}},Object(c.createElement)("div",{id:"clockdiv"},Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"days"}),Object(c.createElement)("div",{className:"smalltext"},"Days")),Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"hours"}),Object(c.createElement)("div",{className:"smalltext"},"Hours")),Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"minutes"}),Object(c.createElement)("div",{className:"smalltext"},"Minutes")),Object(c.createElement)("div",null,Object(c.createElement)("span",{className:"seconds"}),Object(c.createElement)("div",{className:"smalltext"},"Seconds")),Object(c.createElement)(i.InnerBlocks.Content,null))))}})},function(e,t,n){var a;!function(){"use strict";var n={}.hasOwnProperty;function l(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var c=typeof a;if("string"===c||"number"===c)e.push(a);else if(Array.isArray(a)){if(a.length){var o=l.apply(null,a);o&&e.push(o)}}else if("object"===c)if(a.toString===Object.prototype.toString)for(var r in a)n.call(a,r)&&a[r]&&e.push(r);else e.push(a.toString())}}return e.join(" ")}e.exports?(l.default=l,e.exports=l):void 0===(a=function(){return l}.apply(t,[]))||(e.exports=a)}()}]);