<?php
/**
 * Presents the page the same to all.
 *
 * PHP version 5
 *
 * @category Index
 * @package  FOGProject
 * @author   Tom Elliott <tommygunsster@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
/**
 * Presents the page the same to all.
 *
 * @category Index
 * @package  FOGProject
 * @author   Tom Elliott <tommygunsster@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
echo '<!DOCTYPE html>';
echo '<html lang="'
    . ProcessLogin::getLocale()
    . '">';
echo '<head>';
//CES_CUSTOMIZATION MONITORING START 
echo '<script type="text/javascript">';
echo '!function(T,l,y){var S=T.location,k="script",D="connectionString",C="ingestionendpoint",I="disableExceptionTracking",E="ai.device.",b="toLowerCase",w="crossOrigin",N="POST",e="appInsightsSDK",t=y.name||"appInsights";(y.name||T[e])&&(T[e]=t);var n=T[t]||function(d){var g=!1,f=!1,m={initialize:!0,queue:[],sv:"5",version:2,config:d};function v(e,t){var n={},a="Browser";return n[E+"id"]=a[b](),n[E+"type"]=a,n["ai.operation.name"]=S&&S.pathname||"_unknown_",n["ai.internal.sdkVersion"]="javascript:snippet_"+(m.sv||m.version),{time:function(){var e=new Date;function t(e){var t=""+e;return 1===t.length&&(t="0"+t),t}return e.getUTCFullYear()+"-"+t(1+e.getUTCMonth())+"-"+t(e.getUTCDate())+"T"+t(e.getUTCHours())+":"+t(e.getUTCMinutes())+":"+t(e.getUTCSeconds())+"."+((e.getUTCMilliseconds()/1e3).toFixed(3)+"").slice(2,5)+"Z"}(),name:"Microsoft.ApplicationInsights."+e.replace(/-/g,"")+"."+t,sampleRate:100,tags:n,data:{baseData:{ver:2}}}}var h=d.url||y.src;if(h){function a(e){var t,n,a,i,r,o,s,c,u,p,l;g=!0,m.queue=[],f||(f=!0,t=h,s=function(){var e={},t=d.connectionString;if(t)for(var n=t.split(";"),a=0;a<n.length;a++){var i=n[a].split("=");2===i.length&&(e[i[0][b]()]=i[1])}if(!e[C]){var r=e.endpointsuffix,o=r?e.location:null;e[C]="https:////"+(o?o+".":"")+"dc."+(r||"services.visualstudio.com")}return e}(),c=s[D]||d[D]||"",u=s[C],p=u?u+"/v2/track":d.endpointUrl,(l=[]).push((n="SDK LOAD Failure: Failed to load Application Insights SDK script (See stack for details)",a=t,i=p,(o=(r=v(c,"Exception")).data).baseType="ExceptionData",o.baseData.exceptions=[{typeName:"SDKLoadFailed",message:n.replace(/\\./g,"-"),hasFullStack:!1,stack:n+"\\nSnippet failed to load ["+a+"] -- Telemetry is disabled\\nHelp Link: https:////go.microsoft.com/fwlink/?linkid=2128109\\nHost: "+(S&&S.pathname||"_unknown_")+"\\nEndpoint: "+i,parsedStack:[]}],r)),l.push(function(e,t,n,a){var i=v(c,"Message"),r=i.data;r.baseType="MessageData";var o=r.baseData;return o.message=\'AI (Internal): 99 message:"\'+("SDK LOAD Failure: Failed to load Application Insights SDK script (See stack for details) ("+n+")").replace(/\\"/g,"")+\'"\',o.properties={endpoint:a},i}(0,0,t,p)),function(e,t){if(JSON){var n=T.fetch;if(n&&!y.useXhr)n(t,{method:N,body:JSON.stringify(e),mode:"cors"});else if(XMLHttpRequest){var a=new XMLHttpRequest;a.open(N,t),a.setRequestHeader("Content-type","application/json"),a.send(JSON.stringify(e))}}}(l,p))}function i(e,t){f||setTimeout(function(){!t&&m.core||a()},500)}var e=function(){var n=l.createElement(k);n.src=h;var e=y[w];return!e&&""!==e||"undefined"==n[w]||(n[w]=e),n.onload=i,n.onerror=a,n.onreadystatechange=function(e,t){"loaded"!==n.readyState&&"complete"!==n.readyState||i(0,t)},n}();y.ld<0?l.getElementsByTagName("head")[0].appendChild(e):setTimeout(function(){l.getElementsByTagName(k)[0].parentNode.appendChild(e)},y.ld||0)}try{m.cookie=l.cookie}catch(p){}function t(e){for(;e.length;)!function(t){m[t]=function(){var e=arguments;g||m.queue.push(function(){m[t].apply(m,e)})}}(e.pop())}var n="track",r="TrackPage",o="TrackEvent";t([n+"Event",n+"PageView",n+"Exception",n+"Trace",n+"DependencyData",n+"Metric",n+"PageViewPerformance","start"+r,"stop"+r,"start"+o,"stop"+o,"addTelemetryInitializer","setAuthenticatedUserContext","clearAuthenticatedUserContext","flush"]),m.SeverityLevel={Verbose:0,Information:1,Warning:2,Error:3,Critical:4};var s=(d.extensionConfig||{}).ApplicationInsightsAnalytics||{};if(!0!==d[I]&&!0!==s[I]){var c="onerror";t(["_"+c]);var u=T[c];T[c]=function(e,t,n,a,i){var r=u&&u(e,t,n,a,i);return!0!==r&&m["_"+c]({message:e,url:t,lineNumber:n,columnNumber:a,error:i}),r},d.autoExceptionInstrumented=!0}return m}(y.cfg);function a(){y.onInit&&y.onInit(n)}(T[t]=n).queue&&0===n.queue.length?(n.queue.push(a),n.trackPageView({})):a()}(window,document,{';
echo 'src: "https:////js.monitor.azure.com/scripts/b/ai.2.min.js", ';
echo 'crossOrigin: "anonymous", ';
echo 'cfg: { ';
echo '    connectionString: "InstrumentationKey=7550446e-904d-4171-bcf9-2c4fe3718cb7;IngestionEndpoint=https://westus2-2.in.applicationinsights.azure.com/;LiveEndpoint=https://westus2.livediagnostics.monitor.azure.com/"';
echo '}});';
echo '</script>';
//CES_CUSTOMIZATION MONITORING END 
echo '<meta charset="utf-8"/>';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge"/>';
echo '<meta name="viewport" content="width=device-width, initial-scale=1"/>';
echo '<title>' . $this->pageTitle . '</title>';
self::$HookManager
    ->processEvent(
        'CSS',
        array(
            'stylesheets' => &$this->stylesheets
        )
    );
foreach ((array)$this->stylesheets as &$stylesheet) {
    echo '<link href="'
        . $stylesheet
        . '?ver='
        . FOG_BCACHE_VER
        . '" rel="stylesheet" type="text/css"/>';
    unset($stylesheet);
}
unset($this->stylesheets);
echo '<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>';
echo '</head>';
echo '<body >';
if (self::$FOGUser->isValid()) {
    /**
     * Navigation items
     */
    //CES_CUSTOMIZATION 20220323 START  
    //echo '<nav class="navbar navbar-inverse navbar-fixed-top">';
    echo '<nav class="navbar navbar-fixed-top" style="background-color: #f8f8f8;border-color: #337AB7">';
    //CES_CUSTOMIZATION 20220323 END        
    echo '<div class="container-fluid">';
    echo '<div class="navbar-header">';
    echo '<button type="button" class="navbar-toggle collapsed" data-toggle="'
        . 'collapse" data-target=".navbar-collapse">';
    echo '<span class="sr-only">'
        . _('Toggle Navigation')
        . '</span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="collapse navbar-collapse">';
    echo '<ul class="nav navbar-nav">';
    echo '<a class="navbar-brand" href="../management/index.php?node=home">';
    //CES_CUSTOMIZATION 20220301 START  
    //echo '<b>FOG</b> Project';
    echo '<div><img style="width:100%;position:relative" src="../pxelhdr.png" class="logoimg" alt="'._('FOG Project') . '"/></div>';
    //CES_CUSTOMIZATION 20220301 END        
    echo '</a>';
    self::getSearchForm();
    echo $this->menu;
    self::getLogout();
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
    self::$HookManager
        ->processEvent(
            'CONTENT_DISPLAY',
            array(
                'content' => &$this->body,
                'sectionTitle' => &$this->sectionTitle,
                'pageTitle' => &$this->pageTitle
            )
        );
    /**
     * Main Content
     */
    echo '<div class="container-fluid'
        . (
            $this->isHomepage ?
            ' dashboard' :
            ''
        )
        . '">';

    //CES_CUSTOMIZATION 20220302 START localized edit mode with :
    if(strpos($this->sectionTitle,":") == true)
        $this->sectionTitle = _(substr($this->sectionTitle,0,strpos($this->sectionTitle,":"))) .substr($this->sectionTitle,strpos($this->sectionTitle,":"));
    //CES_CUSTOMIZATION 20220302 END localized

    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading text-center">';
    echo '<h4 class="title">'
        . _($this->sectionTitle)
        . '</h4>';
    if (self::$FOGUser->isValid && $this->pageTitle) {
        echo '<h5 class="title">'
            . $this->pageTitle
            . '</h5>';
    }
    echo '</div>';
    echo '<input type="hidden" class="fog-delete" id="FOGDeleteAuth" value="'
        . (int)self::$fogdeleteactive
        . '"/>';
    echo '<input type="hidden" class="fog-export" id="FOGExportAuth" value="'
        . (int)self::$fogexportactive
        . '"/>';
    echo '<input type="hidden" class="fog-variable" id="screenview" value="'
        . self::$defaultscreen
        . '"/>';
    echo '<div class="panel-body">';
    self::getMenuItems();
    self::getMainSideMenu();
    echo $this->body;
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    //CES_CUSTOMIZATION 20220323 START     
    //echo '<nav class="navbar navbar-inverse navbar-fixed-top">';
    //CES_CUSTOMIZATION 20220323 END     
    echo '<div class="container-fluid">';
    echo '<div class="navbar-header">';
    echo '<button type="button" class="navbar-toggle collapsed" data-toggle="'
        . 'collapse" data-target=".navbar-collapse">';
    echo '<span class="sr-only">'
        . _('Toggle Navigation')
        . '</span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="collapse navbar-collapse">';
    echo '<ul class="nav navbar-nav">';
    echo '<a class="navbar-brand" href="../management/index.php?node=home">';
    //CES_CUSTOMIZATION 20220301 START        
    //echo '<b>FOG</b> Project';
    //echo _('FOG Project');
    //echo '<p> <img style="width:100%;position:relative" src="../pxelhdr.png" class="logoimg" alt="'._('FOG Project') . '"/> </p>';
    //CES_CUSTOMIZATION 20220301 END        
    echo '</a>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
    /**
     * Main Content
     */
    echo '<div class="container-fluid'
        . (
            $this->isHomepage ?
            ' dashboard' :
            ''
        )
        . '">';
    echo $this->body;
    echo '</div>';
}
     
echo '<div class="collapse navbar-collapse" style="visibility:hidden;display:none" >'; //CES_CUSTOMIZATION 20220301 (Hide footer)   
echo '<footer class="footer">';
echo '<nav class="navbar navbar-inverse navbar-fixed-bottom">';
echo '<div class="container-fluid">';
echo '<ul class="nav navbar-nav">';
echo '<li><a href="https://wiki.fogproject.org/wiki/index.php?title=Credits">'
    . _('Credits')
    . '</a></li>';
echo '<li><a href="?node=client">'
    . _('FOG Client')
    . '</a></li>';
echo '<li><a href="https://www.paypal.com/cgi-bin/webscr?item_name=Donation'
    . '+to+FOG+-+A+Free+Cloning+Solution&cmd=_donations&business=fogproject.org'
    . '@gmail.com" target="_blank">'
    . _('Donate to FOG')
    . '</a></li>';
if (self::$FOGUser->isValid()) {
    echo '<li class="pull-right">';
    echo '<a href="../management/index.php?node=about">';
    echo '<b>';
    echo _('Version');
    echo '</b> ';
    echo FOG_VERSION;
    echo '</a>';
    echo '</li>';
}
echo '</ul>';
echo '</div>';
echo '</nav>';
echo '</footer>';
echo '</div>';


foreach ((array)$this->javascripts as &$javascript) {
    echo '<script src="'
        . $javascript
        . '?ver='
        . FOG_BCACHE_VER
        . '" type="text/javascript"></script>';
    unset($javascript);
}
unset($this->javascripts);
echo '<!-- Memory Usage: ';
echo self::formatByteSize(memory_get_usage(true));
echo '-->';
echo '<!-- Memory Peak: ';
echo self::formatByteSize(memory_get_peak_usage());
echo '-->';
echo '</body>';
echo '</html>';
