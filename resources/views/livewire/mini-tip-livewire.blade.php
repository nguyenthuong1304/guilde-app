<div class="sok-NewTab">
   <span class="sok-NewTab-contentContainer">
      <span class="sok-NewTab-contentHeader">
         <span class="sok-Chip sok-Chip-python">Python</span>
      </span>
      <div class="sok-MarkdownRenderer ">
         <h3>decapitalize</h3>
         <p>Decapitalizes the first letter of a string.</p>
         <p>Decapitalizes the first letter of the string and then adds it with rest of the string. Omit the <code>upper_rest</code> parameter to keep the rest of the string intact, or set it to <code>True</code> to convert to uppercase.</p>
         <div class="sok-MarkdownSyntaxHighlighter">
            <pre><code class="language-python hljs"><span class="hljs-function"><span class="hljs-keyword">def</span> <span class="hljs-title">decapitalize</span><span class="hljs-params">(string, upper_rest=False)</span>:</span>
    <span class="hljs-keyword">return</span> str[:<span class="hljs-number">1</span>].lower() + (str[<span class="hljs-number">1</span>:].upper() <span class="hljs-keyword">if</span> upper_rest <span class="hljs-keyword">else</span> str[<span class="hljs-number">1</span>:])</code></pre>
         </div>
         <div class="sok-MarkdownSyntaxHighlighter">
            <pre><code class="language-python hljs">decapitalize(<span class="hljs-string">'FooBar'</span>) <span class="hljs-comment"># 'fooBar'</span>
decapitalize(<span class="hljs-string">'FooBar'</span>, <span class="hljs-keyword">True</span>) <span class="hljs-comment"># 'fOOBAR'</span></code></pre>
         </div>
      </div>
   </span>
  <div class="mb-2 d-none" id="render" data-markdown="{{ $tip->content }}"></div>
  </div>
@section('styles')
    <style type="text/css">
      .sok-MarkdownSyntaxHighlighter {
        position: relative;
      }

      .sok-MarkdownSyntaxHighlighter .sok-Button {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        bottom: -15px;
        right: -15px;
        width: 40px;
        height: 40px;
        min-width: unset;
        max-width: unset;
        border-radius: 50%;
        border: none;
        background: var(--color__white);
      }

      .sok-MarkdownSyntaxHighlighter .sok-Button:hover {
        transform: scale(1.2);
      }

      .sok-MarkdownSyntaxHighlighter .sok-Button > .sok-Button-icon {
        margin: 0;
        font-size: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .sok-MarkdownSyntaxHighlighter pre {
        margin-top: 32px !important;
      }

      .sok-MarkdownRenderer {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        line-height: 1.5;
        color: var(--font__color--primary);
        font-size: 16px;
        padding: 24px 0;
        word-wrap: break-word;
        border-top: 1px solid var(--color__border);
        border-bottom: 1px solid var(--color__border);
      }

      .sok-MarkdownRenderer .pl-c {
        color: #6a737d;
      }

      .sok-MarkdownRenderer .pl-c1,
      .sok-MarkdownRenderer .pl-s .pl-v {
        color: #005cc5;
      }

      .sok-MarkdownRenderer .pl-e,
      .sok-MarkdownRenderer .pl-en {
        color: #6f42c1;
      }

      .sok-MarkdownRenderer .pl-smi,
      .sok-MarkdownRenderer .pl-s .pl-s1 {
        color: var(--font__color--primary);
      }

      .sok-MarkdownRenderer .pl-ent {
        color: #22863a;
      }

      .sok-MarkdownRenderer .pl-k {
        color: #d73a49;
      }

      .sok-MarkdownRenderer .pl-s,
      .sok-MarkdownRenderer .pl-pds,
      .sok-MarkdownRenderer .pl-s .pl-pse .pl-s1,
      .sok-MarkdownRenderer .pl-sr,
      .sok-MarkdownRenderer .pl-sr .pl-cce,
      .sok-MarkdownRenderer .pl-sr .pl-sre,
      .sok-MarkdownRenderer .pl-sr .pl-sra {
        color: #032f62;
      }

      .sok-MarkdownRenderer .pl-v,
      .sok-MarkdownRenderer .pl-smw {
        color: #e36209;
      }

      .sok-MarkdownRenderer .pl-bu {
        color: #b31d28;
      }

      .sok-MarkdownRenderer .pl-ii {
        color: #fafbfc;
        background-color: #b31d28;
      }

      .sok-MarkdownRenderer .pl-c2 {
        color: #fafbfc;
        background-color: #d73a49;
      }

      .sok-MarkdownRenderer .pl-c2:before {
        content: '^M';
      }

      .sok-MarkdownRenderer .pl-sr .pl-cce {
        font-weight: bold;
        color: #22863a;
      }

      .sok-MarkdownRenderer .pl-ml {
        color: #735c0f;
      }

      .sok-MarkdownRenderer .pl-mh,
      .sok-MarkdownRenderer .pl-mh .pl-en,
      .sok-MarkdownRenderer .pl-ms {
        font-weight: bold;
        color: #005cc5;
      }

      .sok-MarkdownRenderer .pl-mi {
        font-style: italic;
        color: var(--font__color--primary);
      }

      .sok-MarkdownRenderer .pl-mb {
        font-weight: bold;
        color: var(--font__color--primary);
      }

      .sok-MarkdownRenderer .pl-md {
        color: #b31d28;
        background-color: #ffeef0;
      }

      .sok-MarkdownRenderer .pl-mi1 {
        color: #22863a;
        background-color: #f0fff4;
      }

      .sok-MarkdownRenderer .pl-mc {
        color: #e36209;
        background-color: #ffebda;
      }

      .sok-MarkdownRenderer .pl-mi2 {
        color: var(--color__gray);
        background-color: #005cc5;
      }

      .sok-MarkdownRenderer .pl-mdr {
        font-weight: bold;
        color: #6f42c1;
      }

      .sok-MarkdownRenderer .pl-ba {
        color: #586069;
      }

      .sok-MarkdownRenderer .pl-sg {
        color: #959da5;
      }

      .sok-MarkdownRenderer .pl-corl {
        text-decoration: underline;
        color: #032f62;
      }

      .sok-MarkdownRenderer .octicon {
        display: inline-block;
        fill: currentColor;
        vertical-align: text-bottom;
      }

      .sok-MarkdownRenderer a {
        background-color: transparent;
        color: var(--font__color--secondary);
        text-decoration: none;
      }

      .sok-MarkdownRenderer a:active,
      .sok-MarkdownRenderer a:hover {
        outline-width: 0;
      }

      .sok-MarkdownRenderer strong {
        font-weight: 700;
      }

      .sok-MarkdownRenderer h1 {
        margin: 0.67em 0;
        font-weight: 700;
        padding-bottom: 0.3em;
        font-size: 2.5em;
        border-bottom: 1px solid #eaecef;
      }

      .sok-MarkdownRenderer img {
        border-style: none;
        max-width: 100%;
        box-sizing: content-box;
      }

      .sok-MarkdownRenderer code,
      .sok-MarkdownRenderer kbd,
      .sok-MarkdownRenderer pre {
        font-size: 1em;
      }

      .sok-MarkdownRenderer hr {
        box-sizing: content-box;
        overflow: hidden;
        background: transparent;
        height: 0.25em;
        padding: 0;
        margin: 24px 0;
        border: 0;
        border-bottom: 1px solid var(--color__border);
      }

      .sok-MarkdownRenderer input {
        font: inherit;
        margin: 0;
        overflow: visible;
      }

      .sok-MarkdownRenderer [type='checkbox'] {
        box-sizing: border-box;
        margin-right: 10px;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        cursor: default;
      }

      .sok-MarkdownRenderer * {
        box-sizing: border-box;
      }

      .sok-MarkdownRenderer a:hover {
        text-decoration: underline;
      }

      .sok-MarkdownRenderer hr:before {
        display: table;
        content: '';
      }

      .sok-MarkdownRenderer hr:after {
        display: table;
        clear: both;
        content: '';
      }

      .sok-MarkdownRenderer table {
        border-spacing: 0;
        border-collapse: collapse;
        display: block;
        width: 100%;
        overflow: auto;
      }

      .sok-MarkdownRenderer td,
      .sok-MarkdownRenderer th {
        padding: 0;
      }

      .sok-MarkdownRenderer h1,
      .sok-MarkdownRenderer h2,
      .sok-MarkdownRenderer h3,
      .sok-MarkdownRenderer h4,
      .sok-MarkdownRenderer h5,
      .sok-MarkdownRenderer h6 {
        margin-top: 24px;
        margin-bottom: 16px;
        font-weight: 700;
        line-height: 1.25;
        color: var(--color__secondary--light);
      }

      .sok-MarkdownRenderer h2 {
        font-weight: 700;
        padding-bottom: 0.3em;
        font-size: 2.3em;
        border-bottom: 1px solid #eaecef;
      }

      .sok-MarkdownRenderer h3 {
        font-size: 2.1em;
        font-weight: 700;
      }

      .sok-MarkdownRenderer h4 {
        font-weight: 700;
        font-size: 1.9em;
      }

      .sok-MarkdownRenderer h5 {
        font-weight: 700;
        font-size: 1.7em;
      }

      .sok-MarkdownRenderer h6 {
        font-weight: 700;
        font-size: 1.5em;
        color: #6a737d;
      }

      .sok-MarkdownRenderer p {
        margin-top: 0;
        margin-bottom: 10px;
      }

      .sok-MarkdownRenderer blockquote {
        margin: 0;
        padding: 0 1em;
        color: #6a737d;
        border-left: 0.25em solid var(--color__border);
      }

      .sok-MarkdownRenderer ul,
      .sok-MarkdownRenderer ol {
        margin-top: 0;
        margin-bottom: 0;
        padding-left: 2em;
      }

      .sok-MarkdownRenderer ol ol,
      .sok-MarkdownRenderer ul ol {
        list-style-type: lower-roman;
      }

      .sok-MarkdownRenderer ul ul ol,
      .sok-MarkdownRenderer ul ol ol,
      .sok-MarkdownRenderer ol ul ol,
      .sok-MarkdownRenderer ol ol ol {
        list-style-type: lower-alpha;
      }

      .sok-MarkdownRenderer dd {
        margin-left: 0;
      }

      .sok-MarkdownRenderer code {
        padding: 0.2em 0.4em;
        margin: 0;
        font-size: 85%;
        background-color: rgba(27,31,35,0.05);
        border-radius: 3px;
      }

      .sok-MarkdownRenderer pre {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 1em;
        word-wrap: normal;
      }

      .sok-MarkdownRenderer .pl-0 {
        padding-left: 0 !important;
      }

      .sok-MarkdownRenderer .pl-1 {
        padding-left: 4px !important;
      }

      .sok-MarkdownRenderer .pl-2 {
        padding-left: 8px !important;
      }

      .sok-MarkdownRenderer .pl-3 {
        padding-left: 16px !important;
      }

      .sok-MarkdownRenderer .pl-4 {
        padding-left: 24px !important;
      }

      .sok-MarkdownRenderer .pl-5 {
        padding-left: 32px !important;
      }

      .sok-MarkdownRenderer .pl-6 {
        padding-left: 40px !important;
      }

      .sok-MarkdownRenderer:before {
        display: table;
        content: '';
      }

      .sok-MarkdownRenderer:after {
        display: table;
        clear: both;
        content: '';
      }

      .sok-MarkdownRenderer > *:first-child {
        margin-top: 0 !important;
      }

      .sok-MarkdownRenderer > *:last-child {
        margin-bottom: 0 !important;
      }

      .sok-MarkdownRenderer a:not([href]) {
        color: inherit;
        text-decoration: none;
      }

      .sok-MarkdownRenderer .anchor {
        float: left;
        padding-right: 4px;
        margin-left: -24px;
        line-height: 1;
      }

      .sok-MarkdownRenderer .anchor:focus {
        outline: none;
      }

      .sok-MarkdownRenderer p,
      .sok-MarkdownRenderer blockquote,
      .sok-MarkdownRenderer ul,
      .sok-MarkdownRenderer ol,
      .sok-MarkdownRenderer dl,
      .sok-MarkdownRenderer table,
      .sok-MarkdownRenderer pre {
        margin-top: 0;
        margin-bottom: 16px;
      }

      .sok-MarkdownRenderer blockquote > :first-child {
        margin-top: 0;
      }

      .sok-MarkdownRenderer blockquote > :last-child {
        margin-bottom: 0;
      }

      .sok-MarkdownRenderer kbd {
        padding: 3px 5px;
        color: #444d56;
        vertical-align: middle;
        background-color: #fafbfc;
        border-radius: 3px;
        display: inline-block;
        font: 11px 'SFMono-Regular', 'Consolas', 'Liberation Mono', 'Menlo', 'Courier', monospace;
        line-height: 10px;
        border: solid 1px #d1d5da;
        border-bottom-color: var(--color__border);
        box-shadow: inset 0 -1px 0 var(--color__gray--light);
      }

      .sok-MarkdownRenderer h1 .octicon-link,
      .sok-MarkdownRenderer h2 .octicon-link,
      .sok-MarkdownRenderer h3 .octicon-link,
      .sok-MarkdownRenderer h4 .octicon-link,
      .sok-MarkdownRenderer h5 .octicon-link,
      .sok-MarkdownRenderer h6 .octicon-link {
        color: #1b1f23;
        vertical-align: middle;
        visibility: hidden;
      }

      .sok-MarkdownRenderer h1:hover .anchor,
      .sok-MarkdownRenderer h2:hover .anchor,
      .sok-MarkdownRenderer h3:hover .anchor,
      .sok-MarkdownRenderer h4:hover .anchor,
      .sok-MarkdownRenderer h5:hover .anchor,
      .sok-MarkdownRenderer h6:hover .anchor {
        text-decoration: none;
      }

      .sok-MarkdownRenderer h1:hover .anchor .octicon-link,
      .sok-MarkdownRenderer h2:hover .anchor .octicon-link,
      .sok-MarkdownRenderer h3:hover .anchor .octicon-link,
      .sok-MarkdownRenderer h4:hover .anchor .octicon-link,
      .sok-MarkdownRenderer h5:hover .anchor .octicon-link,
      .sok-MarkdownRenderer h6:hover .anchor .octicon-link {
        visibility: visible;
      }

      .sok-MarkdownRenderer ul ul,
      .sok-MarkdownRenderer ul ol,
      .sok-MarkdownRenderer ol ol,
      .sok-MarkdownRenderer ol ul {
        margin-top: 0;
        margin-bottom: 0;
      }

      .sok-MarkdownRenderer li {
        word-wrap: break-all;
      }

      .sok-MarkdownRenderer li > p {
        margin-top: 16px;
      }

      .sok-MarkdownRenderer li + li {
        margin-top: 0.25em;
      }

      .sok-MarkdownRenderer dl {
        padding: 0;
      }

      .sok-MarkdownRenderer dl dt {
        padding: 0;
        margin-top: 16px;
        font-size: 1em;
        font-style: italic;
        font-weight: 700;
      }

      .sok-MarkdownRenderer dl dd {
        padding: 0 16px;
        margin-bottom: 16px;
      }

      .sok-MarkdownRenderer table th {
        font-weight: 700;
      }

      .sok-MarkdownRenderer table th,
      .sok-MarkdownRenderer table td {
        padding: 6px 13px;
        border: 1px solid var(--color__border);
      }

      .sok-MarkdownRenderer table tr {
        border-top: 1px solid var(--color__border);
      }

      .sok-MarkdownRenderer table tr:nth-child(2n) {
        background-color: var(--color__gray);
      }

      .sok-MarkdownRenderer img[align='right'] {
        padding-left: 24px;
      }

      .sok-MarkdownRenderer img[align='left'] {
        padding-right: 24px;
      }

      .sok-MarkdownRenderer pre > code {
        padding: 0;
        margin: 0;
        font-size: 100%;
        word-break: normal;
        white-space: pre;
        background: transparent;
        border: 0;
      }

      .sok-MarkdownRenderer .highlight {
        margin-bottom: 16px;
      }

      .sok-MarkdownRenderer .highlight pre {
        margin-bottom: 0;
        word-break: normal;
      }

      .sok-MarkdownRenderer .highlight pre,
      .sok-MarkdownRenderer pre {
        padding: 24px;
        overflow: auto;
        font-size: 85%;
        line-height: 1.45;
        background-color: var(--bg__code--block);
        border-radius: 3px;
      }

      .sok-MarkdownRenderer pre code {
        display: inline;
        max-width: auto;
        padding: 0;
        margin: 0;
        overflow: visible;
        line-height: inherit;
        word-wrap: normal;
        background-color: transparent;
        border: 0;
      }

      .sok-MarkdownRenderer .full-commit .btn-outline:not(:disabled):hover {
        color: #005cc5;
        border-color: #005cc5;
      }

      .sok-MarkdownRenderer :checked + .radio-label {
        position: relative;
        z-index: 1;
        border-color: var(--font__color--primary);
      }

      .sok-MarkdownRenderer .task-list-item {
        list-style-type: none;
      }

      .sok-MarkdownRenderer .task-list-item + .task-list-item {
        margin-top: 3px;
      }

      .sok-MarkdownRenderer .task-list-item input {
        margin: 0 0.2em 0.25em -1.6em;
        vertical-align: middle;
      }
    </style>
    <style type="text/css">/* stylelint-disable */
      .sok-Spinner {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
      }

      .sok-Spinner span {
        display: block;
        position: absolute;
        top: 0; left: 0;
        bottom: 0; right: 0;
        margin: auto;
        height: 32px;
        width: 32px;
      }

      .sok-Spinner span:before,
      .sok-Spinner span:after {
        content: '';
        display: block;
        position: absolute;
        top: 0; left: 0;
        bottom: 0; right: 0;
        margin: auto;
        height: 32px;
        width: 32px;
        border: 2px solid var(--color__white);
        border-radius: 50%;
        opacity: 0;
        animation: var(--animation__pulse--1);
      }

      .sok-Spinner span:after {
        animation: var(--animation__pulse--2);
      }
    </style>
    <style type="text/css">.sok-Chip {
        width: auto;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2.5px 5px;
        font-weight: 900;
        transition: all 0.3s ease-in-out;
      }

      .sok-Chip.sok-Chip-javascript {
        color: #21212a;
        background: var(--color__lang__js);
      }

      .sok-Chip.sok-Chip-react {
        color: #ffffff;
        background: var(--color__lang__react);
      }

      .sok-Chip.sok-Chip-python {
        color: #21212a;
        background: var(--color__lang__python);
      }

      .sok-Chip.sok-Chip-interview {
        color: #ffffff;
        background: var(--color__lang__interview);
      }

      .sok-Chip.sok-Chip-php {
        color: #21212a;
        background: var(--color__lang__php);
      }

      .sok-Chip.sok-Chip-css {
        color: #21212a;
        background: var(--color__lang__css);
      }

      .sok-Chip.sok-Chip-ruby {
        color: #ffffff;
        background: var(--color__lang__ruby);
      }

      .sok-Chip.sok-Chip-ramda {
        color: #ffffff;
        background: var(--color__lang__ramda);
      }

      .sok-Chip.sok-Chip-cpp {
        color: #ffffff;
        background: var(--color__lang__cpp);
      }
    </style>
    <style type="text/css">
      .sok-SaveButton-disabled .sok-SaveButton-button {
        background: var(--color__gray--light) !important;
        color: var(--color__white--dark);
        cursor: not-allowed;
        transform: none;
      }
    </style>
    <style type="text/css">
      .sok-DonationBeggar-message > strong {
        color: var(--color__orange--light);
        font-weight: 900;
      }

      .sok-DonationBeggar > .sok-Button {
        font-weight: 900;
        min-width: unset;
        position: absolute;
        font-size: 16px;
        right: -8px;
        top: -8px;
        width: 48px !important;
        height: 48px !important;
        border-radius: 100%;
      }

      .sok-DonationBeggar > .sok-Button > .sok-SokIcon {
        width: 16px;
        height: 16px;
      }

      .sok-DonationBeggar-button > .sok-SokIcon {
        font-size: 24px;
        height: 26px;
        margin-right: 12px;
      }
    </style>
    <style type="text/css">
      .sok-ControllsOverlay-menu .sok-SokIcon {
        width: 16px;
        height: 16px;
      }

      .sok-ControllsOverlay-menu .sok-ControllsOverlay-menu-items {
        background: var(--color__white);
        border-radius: 24px 24px 0 0;
        padding-bottom: 24px;
        margin-bottom: -24px;
        box-shadow: var(--drop-shadow__regular);
        transform: scaleY(0);
        opacity: 0;
        transform-origin: 0% 100%;
      }

      .sok-ControllsOverlay-menu-opened .sok-ControllsOverlay-menu-items {
        animation: var(--animation__menu_open);
      }

      .sok-ControllsOverlay-menu-closed .sok-ControllsOverlay-menu-items {
        animation: var(--animation__menu_close);
      }

      .sok-ControllsOverlay-menu .sok-ControllsOverlay-menu-items .sok-ControllsOverlay-menu-item {
        margin-bottom: 16px;
      }

      .sok-ControllsOverlay .sok-Button {
        width: 48px;
        height: 48px;
        min-width: unset;
        pointer-events: all;
        border-radius: 50%;
        position: relative;
      }
    </style>
    <style type="text/css">
      .sok-NewTab {
        margin-top: 10%;
        width: 100%;
        height: 100%;
        min-height: 100vh;
        flex-direction: column;
        display: flex;
        justify-content: flex-start;
        align-items: center;
      }

      .sok-NewTab .sok-Header {
        z-index: 9999;
      }

      .sok-NewTab .sok-NewTab-contentContainer {
        display: flex;
        flex-direction: column;
        width: var(--content__width);
        max-width: var(--content__width--max);
        min-height: calc(100vh - 200px);
      }

      .sok-NewTab .sok-NewTab-contentContainer .sok-NewTab-contentHeader {
        display: flex;
        justify-content: space-between;
        width: 100%;
      }

      .sok-NewTab .sok-NewTab-contentContainer .sok-NewTab-contentHeader .sok-NewTab-contentButtons {
        justify-content: space-between;
        width: 50px;
        display: flex;
      }
    </style>
    <style type="text/css">@import url(https://fonts.googleapis.com/css?family=Roboto+Mono:400,500,700);</style>
    <style type="text/css">/* Variables */
      :root {
        --color__lang__js: #F0DB4E;
        --color__lang__react: #009bb7;
        --color__lang__python: linear-gradient(135deg, #56a9ec 0%,#56a9ec 50%,#ffe05d 50%,#ffe05d 100%);
        --color__lang__interview: #5100ff;
        --color__lang__php: #AEB2D5;
        --color__lang__css: #2CAAE1;
        --color__lang__ruby: #B60D01;
        --color__lang__ramda: #884499;
        --color__lang__cpp: #1F6AA4;

        --color__primary: var(--color__gray);
        --color__secondary: var(--color__orange);
        --color__secondary--light: var(--color__orange--light);
        --bg__color: var(--color__gray--dark);
        --drop-shadow__regular: 10px 0 37.6px 2.4px rgba(0, 0, 0, 0.1);
        --drop-shadow__inverse: -10px 0 37.6px 2.4px rgba(0, 0, 0, 0.1);
        --font__color--primary: var(--color__white);
        --font__color--dark: var(--color__white--dark);
        --font__color--black: var(--color__gray--dark);
        --font__color--secondary: var(--color__orange);
        --font__color--secondary--light: var(--color__orange--light);
        --font__size--xxs: 12px;
        --font__size--xs: 14px;
        --font__size--s: 16px;
        --font__size--m: 18px;
        --font__size--l: 20px;
        --font__size--xl: 22px;
        --font__size--xxl: 24px;
        --button__height: 32px;
        --button__width--min: 144px;
        --button__width--max: calc(var(--button__width--min)*2);
        --button__drop-shadow: 0 10px 20px 2px rgba(0,0,0,0.1);
        --filter__button--icon: none;
        --toaster__bg: var(--color__white);
        --toaster__font: var(--color__gray--dark);
        --bg__code--block: var(--color__gray);
        --color__border: var(--color__gray--light);
        --animation__slide_in--up: slide-in-up 1s;
        --animation__slide_in--up__regular: slide-in-up-regular 1s;
        --animation__pulse--1: pulse-1 1.5s cubic-bezier(0.075, 0.820, 0.165, 1.000) infinite;
        --animation__pulse--2: pulse-2 1.5s cubic-bezier(0.075, 0.820, 0.165, 1.000) .25s infinite;
        --animation__slide_in--left: slide-in-blurred-left 0.1s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;
        --animation__slide_in--right: slide-in-blurred-right 1s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;

        --animation__fade_in: fade-in 1s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
        --animation__fade_out: fade-out 1s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;

        --animation__menu_open: menu-open 0.4s cubic-bezier(0.550, 0.055, 0.675, 0.190) both;
        --animation__menu_close: menu-close 0.4s cubic-bezier(0.550, 0.055, 0.675, 0.190) both;
        --content__width--max: 1024px;
        --content__width: calc(100vw - 80px);
        --tab__height: 48px;
      }

      * {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        min-height: 100vh;
        padding: 0;
        font-family: 'Roboto Mono', 'source-code-pro', 'Menlo', 'Monaco', 'Consolas', 'Courier New', monospace;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background: var(--bg__color);
        font-weight: 500;
        font-size: var(--font__size--xxs);
        color: var(--font__color--primary);
      }

      code {
        font-family: 'Roboto Mono', 'source-code-pro', 'Menlo', 'Monaco', 'Consolas', 'Courier New', monospace;
      }

      a {
        text-decoration: none;
        color: var(--font__color--primary);
      }

    </style>
    <style type="text/css">
      [data-icon]:before {
        font-family: "sok-icons" !important;
        content: attr(data-icon);
        font-style: normal !important;
        font-weight: normal !important;
        font-variant: normal !important;
        text-transform: none !important;
        speak: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      [class^="sok-icon-"]:before,
      [class*=" sok-icon-"]:before {
        font-family: "sok-icons" !important;
        font-style: normal !important;
        font-weight: normal !important;
        font-variant: normal !important;
        text-transform: none !important;
        speak: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      .sok-NewTab .sok-MarkdownRenderer {
        width: 100%;
      }
    </style>
    <style type="text/css">/* Dark Theme */

      :root {
        --color__white: #f0f0f7;
        --color__white--dark: #b7b7cd;
        --color__gray: #353740;
        --color__gray--light: #5e5d66;
        --color__gray--dark: #21212a;
        --color__orange: #fe1605;
        --color__orange--light: #fea04f;

        --color__header__gradient: linear-gradient(to top, var(--color__gray--dark) 0%,#14141a 100%);
        --color__footer__gradient: linear-gradient(to bottom, var(--color__gray--dark) 0%,#14141a 100%);
      }
    </style>
    <style type="text/css">
      .hljs {
        display: block;
        overflow-x: auto;
        padding: 0.5em;
        background: #272822; color: #ddd;
      }

      .hljs-tag,
      .hljs-keyword,
      .hljs-selector-tag,
      .hljs-literal,
      .hljs-strong,
      .hljs-name {
        color: #f92672;
      }

      .hljs-code {
        color: #66d9ef;
      }

      .hljs-class .hljs-title {
        color: white;
      }

      .hljs-attribute,
      .hljs-symbol,
      .hljs-regexp,
      .hljs-link {
        color: #bf79db;
      }

      .hljs-string,
      .hljs-bullet,
      .hljs-subst,
      .hljs-title,
      .hljs-section,
      .hljs-emphasis,
      .hljs-type,
      .hljs-built_in,
      .hljs-builtin-name,
      .hljs-selector-attr,
      .hljs-selector-pseudo,
      .hljs-addition,
      .hljs-variable,
      .hljs-template-tag,
      .hljs-template-variable {
        color: #a6e22e;
      }

      .hljs-comment,
      .hljs-quote,
      .hljs-deletion,
      .hljs-meta {
        color: #75715e;
      }

      .hljs-keyword,
      .hljs-selector-tag,
      .hljs-literal,
      .hljs-doctag,
      .hljs-title,
      .hljs-section,
      .hljs-type,
      .hljs-selector-id {
        font-weight: bold;
      }
    </style>
@endsection

@section('scripts')
  <script src="{{ asset('js/markdown-it.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
  <script>
    $(document).ready(function() {
      const renderEl = $('#render');
      var md = window.markdownit({
        html: true,
        linkify: true,
        typographer: true,
        quotes: '“”‘’',
        xhtmlOut: false,
        langPrefix: 'language-',
        highlight: function(str, lang) {
          if (lang && hljs.getLanguage(lang)) {
            try {
              return `<pre class="hljs border"><code class=language-${lang}>` +
                hljs.highlight(str, {
                  language: lang,
                  ignoreIllegals: true
                }).value +
                '</code></pre>';
            } catch (__) {}
          }

          return '<pre class="hljs"><code>' + md.utils.escapeHtml(str) + '</code></pre>';
        }
      });
      var result = md.render(renderEl.attr('data-markdown'));
      renderEl.html(result);
      renderEl.removeAttr('data-markdown');
      $('.linear-background').addClass('d-none');
      const eleRenderList = $('#render-list');
      if (eleRenderList.length) {
        let newList = '<ol class="list-unstyled">';
        renderEl.find('img').attr('loading', 'lazy');
        renderEl.find('h1, h2, h3, h4, h5, h6').each((id, el) => {
          let idName = (Math.random() + 1).toString(36).substring(2);
          $(el).replaceWith(function () {
            let newTag, lv;
            switch (el.tagName) {
              case 'H1':
                newTag = 'h2';
                lv = '1';
                break;
              case 'H2':
                newTag = 'h3';
                lv = '2';
                break;
              case 'H3': newTag = 'h4'; break;
              case 'H4': newTag = 'h5'; break;
              case 'H5': newTag = 'h6'; break;
              default: newTag = 'p';
            }
            if (el.tagName === 'H1' || el.tagName === 'H2') {
              newList += `<li class="list-level-${lv}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="${$(el).html()}"><a href="#${idName}" class="text-decoration-none">${el.innerText}</a></li>`;
            }
            return `<${newTag} id="${idName}"> ${$(this).html()} </${newTag}>`;
          });
        });
        newList += '</ol>';
        eleRenderList.replaceWith(newList);
        $('[data-bs-toggle="tooltip"]').tooltip();
        renderEl.removeClass('d-none');
      }
    });
  </script>
@stop
