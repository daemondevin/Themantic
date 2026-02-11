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
<body class="shop-page">
    
    <!-- Navigation -->
    [[$thematicNavigation]]
    
    <!-- Main Content -->
    <div class="ui container">
        <h1 class="ui header">[[*pagetitle]]</h1>
        
        <div class="ui stackable grid">
            <!-- Filters Sidebar -->
            <div class="four wide column">
                <div class="ui vertical segment">
                    <h3 class="ui header">Filter Products</h3>
                    
                    <h4 class="ui header">Categories</h4>
                    <div class="ui list">
                        <!-- Category filters here -->
                    </div>
                    
                    <h4 class="ui header">Price Range</h4>
                    <div class="ui form">
                        <!-- Price range filter here -->
                    </div>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="twelve wide column">
                <div class="ui four stackable cards">
                    [[!getResources? 
                        &parents=`[[*id]]` 
                        &limit=`12` 
                        &tpl=`productCard`
                        &includeTVs=`1`
                        &processTVs=`1`
                    ]]
                </div>
                
                <!-- Pagination -->
                <div class="ui center aligned container">
                    [[!+page.nav]]
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    [[$thematicFooter]]
    
</body>
</html>
