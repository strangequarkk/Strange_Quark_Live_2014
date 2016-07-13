<h1><a href="$Link">Illustration</a></h1>
 
<ul id="galleryTags" class="galItemArea">
    <li class="current"><a href="{$Link}" class="hoverGlitch">All</a></li>
    <% loop AllTags %>
    <li> | <a href="{$Up.Link}tagged/{$Link}" id="tag{$Link}" class="hoverGlitch">$Title</a></li>
    <% end_loop %>
</ul>
<div id="illustWrapper"> 
<% loop $GroupedGalleryImages().GroupedBy(YearCreated) %>

    <div class="gallerySect">
        <h2>$YearCreated</h2> 
        <ul class="galItemArea">
        <% loop $Children %> 

        <li class="galleryItem" >
            <div class="info" id="image$ID">
                <div class="infoContent">
                        <% if $Title %><h3>$Title</h3><% end_if %>
                        <h4>$Date</h4>
                        <% if $BuyLink %><a href="$BuyLink" class="buyButton" target="_blank">Buy on $BuyLocation</a><% end_if %>
                        <% if $Description%><p>$Description</p><% end_if %> 
                </div>
                <div class="backShade"></div>
            </div>
        <a href='$Image.URL' rel="illusGallery" class="fancybox" data-title-id="image$ID">
                $ThumbnailImage

        </a>
        </li>

        <% end_loop %>
        </ul>
    </div>

<% end_loop %>

</div>
