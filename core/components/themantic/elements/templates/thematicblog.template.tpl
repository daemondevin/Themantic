<!DOCTYPE html>
<html lang="[[++cultureKey]]">
<head>
    <meta charset="[[++modx_charset]]">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>[[*pagetitle]] - [[++site_name]]</title>
    <base href="[[!++site_url]]" />
    
    [[*description:notempty=`<meta name="description" content="[[*description]]">`]]
    [[*keywords:notempty=`<meta name="keywords" content="[[*keywords]]">`]]
    
    [[$thematicHead]]
</head>
<body class="blog-page">
    
    <!-- Navigation -->
    [[$thematicNavigation]]
    
    <!-- Main Content -->
    <div class="ui container">
        <div class="ui stackable grid">
            <!-- Blog Content -->
            <div class="twelve wide column">
                <div class="ui vertical segment">
                    <h1 class="ui header">[[*pagetitle]]</h1>
                    <div class="ui small text">
                        [[*publishedon:strtotime:date=`%B %d, %Y`]] by [[*publishedby:userinfo=`fullname`]]
                    </div>
                    
                    [[*content]]
                    
                    <!-- Tags -->
                    [[*tags:notempty=`
                    <div class="ui horizontal divider">Tags</div>
                    <div class="ui labels">
                        [[*tags]]
                    </div>
                    `]]
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="four wide column">
                <div class="ui vertical segment">
                    <h3 class="ui header">Recent Posts</h3>
                    [[!getResources? &parents=`[[*parent]]` &limit=`5` &tpl=`blogSidebarItem`]]
                </div>
                
                <div class="ui vertical segment">
                    <h3 class="ui header">Categories</h3>
                    [[!getResources? &parents=`[[*parent]]` &limit=`10` &tpl=`categorySidebarItem`]]
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    [[$thematicFooter]]
    
</body>
</html>
