<!DOCTYPE html>
<html lang="en">
<head>
  <% base_tag %>
  $MetaTags(false)
  <title>Strange Quark | $Title</title>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
  
<body>
    <div id="Container">
    <div id="ContactModal">
        <div class="modalShade"></div>
        <div class="formWrap">
            <div class="innerForm">
                <h1>REQUEST WORK</h1>
                $CommissionForm
                <div class="clear"></div>
            </div>
        </div>
    </div>
      <div id="Layout" class="mainWidth">
        $Layout
      </div>

      <div id="Footer">
        <div class="barrier" id="footBarrier"></div>
        <a id="footLogo" href="$BaseHref"></a>
        <div class="mainWidth">
            <div id="Navigation">
                <% if $Menu(1) %>
                <ul>
                  <% loop $Menu(1) %>

                    <li class="$LinkingMode"><a href="$Link" title="$Title" class="hoverGlitch">$MenuTitle</a>
                            <% if $MenuTitle =="Contact"%>
                                <div class="dropUp">
                                    <div class="echoBox">
                                            <a href="#" id="requestWork" class="reqForm">Request Work</a>
                                    </div>
                                </div>
                            <% end_if %> 
                            <% if $MenuTitle =="Blog"%>
                                <div class="dropUp">
                                    <div class="echoBox">

                                    </div>
                                </div>
                            <% end_if %>  
                    </li>
                  <% end_loop %>
                </ul>
               <% end_if %>
              </div>
            <div id="social" >
                <a href="https://twitter.com/_StrangeQuark" class="twitter"></a>
                <a href="http://www.linkedin.com/company/strange-quark-creative/" class="linkedIn"></a>
                <a href="https://www.facebook.com/strangequarkcreative" class="faceBook"></a>
            </div>
            <p id ="copyright">© $Now.Year Strange Quark</p>
          </div>
        </div>
    </div>
    <% include GAnalyticScript %>
</body>
</html>