import {
  registerBlockType,
  unregisterBlockStyle,
  registerBlockStyle
} from '@wordpress/blocks';
import {
  PanelBody,
  RangeControl,
  Button,
  CheckboxControl
} from '@wordpress/components';
import {
  RichText,
  InspectorControls,
  ColorPalette,
  BlockControls,
  AlignmentToolbar,
  MediaUpload,
  MediaUploadCheck,
  InnerBlocks,
  BlockVerticalAlignmentToolbar
} from '@wordpress/block-editor';
wp.domReady( () => {
  unregisterBlockStyle(
    'core/button',
    'fill'
  );
  unregisterBlockStyle(
    'core/button',
    'outline'
  );
  unregisterBlockStyle(
    'core/button',
    'default'
  );
  unregisterBlockStyle(
    'core/button',
    'squared'
  );
  registerBlockStyle(
    'core/button',
    [
      {
        name: 'theme-style',
        label: 'Theme Style',
        isDefault: true,
      },
      {
        name: 'default',
        label: 'No Style'
      }
    ]
  );
});
const classNames = require("classnames");

const CTA_TEMPLATE = [
  ["core/button", { placeholder: "Add Button Text..", className: "is-style-custom-style" }]
];
const GRID_TEMPLATE = [
  ["core/columns", { columns: 3 }, [
    ["core/column", {}, [
      ["core/heading", { placeholder: "Enter heading...", className: "is-style-custom-style" }],
      ["core/paragraph", {
        placeholder: "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.",
        className: "is-style-custom-style"
      }]
    ]],
    ["core/column", {}, [
      ["core/heading", { placeholder: "Enter heading...", className: "is-style-custom-style" }],
      ["core/paragraph", {
        placeholder: "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.",
        className: "is-style-custom-style"
      }]
    ]],
    ["core/column", {}, [
      ["core/heading", { placeholder: "Heading", className: "is-style-custom-style" }],
      ["core/paragraph", {
        placeholder: "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.",
        className: "is-style-custom-style"
      }]
    ]]
  ]
  ]
];
const ALLOWED_BLOCKS = ["core/image", "core/heading", "core/button", "core/paragraph", "core/columns"];



/**
 *
 * Register Custom Blocks
 *
 * **/
registerBlockType("pezigns-starter/mega-block", {
  //built in attributes
  title: "Pezigns Mega Block",
  description: "This block can be used to create a custom anything",
  icon: "format-image",
  category: "text",


  //custom attributes
  attributes: {
    title: {
      type: "string",
      source: "html",
      selector: "h2"
    },
    titleColor: {
      type: "string",
      default: "white"
    },
    bodyColor: {
      type: "string",
      default: "white"
    },
    body: {
      type: "string",
      source: "html",
      selector: "p"
    },
    alignment: {
      type: "string",
      default: "center"
    },
    paddingTop: {
      type: "number",
      default: 0
    },
    paddingRight: {
      type: "number",
      default: 0
    },
    paddingBottom: {
      type: "number",
      default: 0
    },
    paddingLeft: {
      type: "number",
      default: 0
    },
    verticalAlignment: {
      type: "string",
      default: "center"
    },
    backgroundImage: {
      type: "string",
      default: ""
    },
    overlayColor: {
      type: "string",
      default: "black"
    },
    overlayOpacity: {
      type: "number",
      default: 0
    },
    isFullScreen: {
      type: "boolean",
      default: 0
    },
    minWidth: {
      type: "string",
      default: 'none'
    },
    minHeight: {
      type: "string",
      default: 'none'
    },
    overflow:{
      type: "string",
      default:'visible'
    }
  },
  supports: {
    align: true
  },
  //built-in functions
  edit: ({ attributes, className, setAttributes, bgImage }) => {
    const {
      backgroundImage,
      overlayColor,
      alignment,
      paddingTop,
      paddingRight,
      paddingBottom,
      paddingLeft,
      verticalAlignment,
      overlayOpacity,
      isFullScreen,
      minHeight,
      minWidth,
      overflow
    } = attributes;

    //custom functions
    function onChangeTitle(newTitle) {
      setAttributes({ title: newTitle });
    }

    function onChangeBody(newBody) {
      setAttributes({ body: newBody });
    }

    function onTitleColorChange(newTitleColor) {
      setAttributes({ titleColor: newTitleColor });
    }

    function onBodyColorChange(newBodyColor) {
      setAttributes({ bodyColor: newBodyColor });
    }

    function onSelectImage(newImage) {
      setAttributes({ backgroundImage: newImage.sizes.large.url });
      //adjust for diff resolutions
    }
    const onRemoveImage = () => {
      setAttributes( {
        backgroundImage: {
          type: "string",
          default: ""
        }
      } );
    };

    function onOverlayColorChange(newColor) {
      setAttributes({ overlayColor: newColor });
    }

    function onOverlayOpacityChange(newOpacity) {
      setAttributes({ overlayOpacity: newOpacity });
    }

    function onChangeAlignment(newAlignment) {
      setAttributes({ alignment: newAlignment });
    }

    function onChangeVerticalAlignment(newVerticalAlignment) {
      setAttributes({ verticalAlignment: newVerticalAlignment });
    }
    function onChangePaddingTop(newPaddingTop) {
      setAttributes({ paddingTop: newPaddingTop });
    }
    function onChangePaddingRight(newPaddingRight) {
      setAttributes({ paddingRight: newPaddingRight });
    }
    function onChangePaddingBottom(newPaddingBottom) {
      setAttributes({ paddingBottom: newPaddingBottom });
    }
    function onChangePaddingLeft(newPaddingLeft) {
      setAttributes({ paddingLeft: newPaddingLeft });
    }
    function onChangeIsFullScreen(newFullScreen) {
      setAttributes({ isFullScreen: newFullScreen });
      if(isFullScreen == false){
        //if fullscreen is selcted
        setAttributes({ minHeight: `100vh` });
        setAttributes({ minWidth: `100vw` });
      }else{
        //if fullscreen is NOT selcted
        setAttributes({ overflow: `hidden` });
        setAttributes({ minHeight: `none` });
        setAttributes({ minWidth: `none` });
      }
    }

    const classes = classNames("mega-block-inner", {
      [`is-vertically-aligned-${ verticalAlignment }`]: verticalAlignment
    });
    //JSX
    return (
      <React.Fragment>
        <InspectorControls style={{ marginBottom: "40px" }}>
          <PanelBody title={"Background Image Settings"}>
            <p>Select a Background Image:</p>
            <MediaUploadCheck>
              <MediaUpload key="upload" onSelect={onSelectImage} type="image" value={backgroundImage} render={({ open }) => {
                  return (
                    <React.Fragment>
                      <img src={backgroundImage} onClick={open}/>
                      <Button className="editor-media-placeholder__button is-button is-default is-large" icon="upload" onClick={open}>Select Background Image</Button>
                    </React.Fragment>
                  );
                }}
               />
            </MediaUploadCheck>
            { !! backgroundImage && bgImage &&
            <MediaUploadCheck>
                <MediaUpload key="upload" onSelect={onSelectImage} type="image" value={backgroundImage} render={({ open }) => {
                    return (
                      <React.Fragment>
                        <img src={backgroundImage} onClick={open}/>
                        <Button className="editor-media-placeholder__button is-button is-default is-large" icon="upload" onClick={open}>Replace Background Image</Button>
                      </React.Fragment>
                    );
                  }}
                />
            </MediaUploadCheck>
            }
            { !! backgroundImage &&
              <MediaUploadCheck>
                <Button onClick={ onRemoveImage } isLink isDestructive>
                  Remove Background Image
                </Button>
              </MediaUploadCheck>
            }
          </PanelBody>
          <PanelBody title={"Overlay Settings"}>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <p>Overlay Color:</p>
              <ColorPalette key="overlay-color" value={overlayColor} onChange={onOverlayColorChange}/>
            </div>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <RangeControl key="overlay-opacity" label={"Overlay Opacity:"} value={overlayOpacity} onChange={onOverlayOpacityChange} min={0} max={1} step={0.01}/>
            </div>
          </PanelBody>
          <PanelBody title={"Padding Settings"}>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <RangeControl key="container-padding-top" label={"Padding Top:"} value={paddingTop} onChange={onChangePaddingTop} min={0} max={100} step={1}/>
            </div>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <RangeControl key="container-padding-right" label={"Padding Right:"} value={paddingRight} onChange={onChangePaddingRight} min={0} max={100} step={1}/>
            </div>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <RangeControl key="container-padding-bottom" label={"Padding Bottom:"} value={paddingBottom} onChange={onChangePaddingBottom} min={0} max={100} step={1}/>
            </div>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <RangeControl key="container-padding-left" label={"Padding Left:"} value={paddingLeft} onChange={onChangePaddingLeft} min={0} max={100} step={1}/>
            </div>
          </PanelBody>
          <PanelBody title={"Full Screen Setting"}>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <CheckboxControl
                label="Fullscreen Mega Block"
                help="This sets the minimum height if the block to fullscreen"
                checked={ isFullScreen }
                onChange={ onChangeIsFullScreen }
              />
            </div>
          </PanelBody>

        </InspectorControls>

        <div className="mega-block-container" style={{
          backgroundImage: `url('${backgroundImage}')`,
          backgroundSize: `cover`,
          backgroundPosition: `center center`,
          backgroundRepeat: `no-repeat`,
          textAlign: alignment,
          paddingTop: `${ paddingTop }%`,
          paddingRight: `${ paddingRight }%`,
          paddingBottom: `${ paddingBottom }%`,
          paddingLeft: `${ paddingLeft }%`,
          verticalAlign:verticalAlignment,
          minHeight,
          minWidth
        }}>
          <div className={"mega-block-overlay"} style={{ background: overlayColor, opacity: overlayOpacity, minHeight, minWidth, height: `100%`, width: `100%`  }}></div>
          <BlockControls>
            <AlignmentToolbar value={alignment} onChange={onChangeAlignment}/>
            <BlockVerticalAlignmentToolbar onChange={onChangeVerticalAlignment} value={verticalAlignment}/>
          </BlockControls>
          <InnerBlocks/>
        </div>
      </React.Fragment>
    );
  },
  save: ({ attributes }) => {
    const {
      alignment,
      paddingTop,
      paddingRight,
      paddingBottom,
      paddingLeft,
      backgroundImage,
      overlayColor,
      overlayOpacity,
      verticalAlignment,
      minHeight,
      minWidth
    } = attributes;
    return (
      <div className="mega-block-container" style={{
        backgroundImage: `url('${backgroundImage}')`,
        backgroundSize: `cover`,
        backgroundPosition: `center center`,
        backgroundRepeat: `no-repeat`,
        textAlign: alignment,
        paddingTop: `${ paddingTop }% !important`,
        paddingRight: `${ paddingRight }% !important`,
        paddingBottom: `${ paddingBottom }% !important`,
        paddingLeft: `${ paddingLeft }% !important`,
        verticalAlign:verticalAlignment,
        minHeight,
        minWidth
      }}>
        <div className="mega-block-overlay" style={{ background: overlayColor, opacity: overlayOpacity, minHeight, minWidth, height: `100%`, width: `100%`  }}></div>
        <div className="mega-block-inner" style={{ textAlign: alignment, verticalAlign: verticalAlignment, minHeight, minWidth  }}>
          <InnerBlocks.Content/>
        </div>
      </div>
    );
  }
});
registerBlockType("pezigns-starter/count-down-block", {

  //built in attributes
  title: "Pezigns Count Down Block",
  description: "This block can be used to create a count down timer anything",
  icon: "format-image",
  category: "text",


  //custom attributes
  attributes: {
    countDownDate: {
      type: "string",
    },
    title: {
      type: "string",
      source: "html",
      selector: "h2"
    },
    titleColor: {
      type: "string",
      default: "white"
    },
    bodyColor: {
      type: "string",
      default: "white"
    },
    body: {
      type: "string",
      source: "html",
      selector: "p"
    },
    alignment: {
      type: "string",
      default: "center"
    },
    verticalAlignment: {
      type: "string",
      default: "center"
    },
    backgroundImage: {
      type: "string",
    },
    overlayColor: {
      type: "string",
      default: "black"
    },
    overlayOpacity: {
      type: "number",
      default: 0.6
    }
  },
  supports: {
    align: true
  },
  //built-in functions
  edit: ({ attributes, className, setAttributes }) => {
    const {
      backgroundImage,
      overlayColor,
      alignment,
      verticalAlignment,
      overlayOpacity,
      countDownDate
    } = attributes;

    //custom functions
    function onChangeTitle(newTitle) {
      setAttributes({ title: newTitle });
    }

    function onChangeBody(newBody) {
      setAttributes({ body: newBody });
    }

    function onTitleColorChange(newTitleColor) {
      setAttributes({ titleColor: newTitleColor });
    }

    function onBodyColorChange(newBodyColor) {
      setAttributes({ bodyColor: newBodyColor });
    }

    function onSelectImage(newImage) {
      setAttributes({ backgroundImage: newImage.sizes.full.url });
      //adjust for diff resolutions
    }

    function onOverlayColorChange(newColor) {
      setAttributes({ overlayColor: newColor });
    }

    function onOverlayOpacityChange(newOpacity) {
      setAttributes({ overlayOpacity: newOpacity });
    }

    function onChangeAlignment(newAlignment) {
      setAttributes({ alignment: newAlignment });
    }

    function onChangeVerticalAlignment(newVerticalAlignment) {
      setAttributes({ verticalAlignment: newVerticalAlignment });
    }
    function onChangeCountDownDate(newCountDownDate) {
      setAttributes({ countDownDate: newCountDownDate });
    }

    const classes = classNames("count-down-inner", {
      [`is-vertically-aligned-${ verticalAlignment }`]: verticalAlignment
    });
    // MyComponent();
    //JSX
    return (
      <React.Fragment>

        <InspectorControls style={{ marginBottom: "40px" }}>
          <PanelBody title={"Background Image Settings"}>

            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <p>Overlay Color:</p>
              <ColorPalette key="overlay-color" value={overlayColor} onChange={onOverlayColorChange}/>
            </div>
            <div style={{ marginTop: "20px", marginBottom: "40px" }}>
              <RangeControl key="overlay-opacity" label={"Overlay Opacity:"} value={overlayOpacity} onChange={onOverlayOpacityChange} min={0} max={1} step={0.01}/>
            </div>
          </PanelBody>

        </InspectorControls>

        <div className="count-down-container" style={{
          backgroundImage: `url(${backgroundImage})`,
          backgroundSize: `cover`,
          backgroundPosition: `center`,
          backgroundRepeat: `no-repeat`,
          textAlign: alignment
        }}>
          <div className={"count-down-overlay"} style={{ background: overlayColor, opacity: overlayOpacity }}></div>
          <BlockControls>
            <AlignmentToolbar value={alignment} onChange={onChangeAlignment}/>
            <BlockVerticalAlignmentToolbar onChange={onChangeVerticalAlignment} value={verticalAlignment}/>
          </BlockControls>
<RichText value={countDownDate}
          onChange={onChangeCountDownDate}/>
          <div id="clockdiv">
            <div>
              <span className="days"></span>
              <div className="smalltext">Days</div>
            </div>
            <div>
              <span className="hours"></span>
              <div className="smalltext">Hours</div>
            </div>
            <div>
              <span className="minutes"></span>
              <div className="smalltext">Minutes</div>
            </div>
            <div>
              <span className="seconds"></span>
              <div className="smalltext">Seconds</div>
            </div>
          </div>
          <InnerBlocks />
        </div>
      </React.Fragment>
    );
  },
  save: ({ attributes }) => {
    const {
      alignment,
      backgroundImage,
      overlayColor,
      overlayOpacity
    } = attributes;
    return (
      <div className="count-down-container">
        <div className="count-down-overlay" style={{ background: overlayColor, opacity: overlayOpacity }}></div>
        <div className="count-down-inner" style={{ textAlign: alignment }}>
          <div id="clockdiv">
            <div>
              <span className="days"></span>
              <div className="smalltext">Days</div>
            </div>
            <div>
              <span className="hours"></span>
              <div className="smalltext">Hours</div>
            </div>
            <div>
              <span className="minutes"></span>
              <div className="smalltext">Minutes</div>
            </div>
            <div>
              <span className="seconds"></span>
              <div className="smalltext">Seconds</div>
            </div>
            <InnerBlocks.Content />
          </div>

        </div>
      </div>
    );
  }
});
