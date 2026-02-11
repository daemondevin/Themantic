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
<body class="[[*template:notempty=`template-[[*template:lcase]]`]] [[*id:is=`[[++site_start]]`:then=`home`:else=``]]">
    
    <!-- Navigation -->
    [[$thematicNavigation]]
    
    <!-- Main Content -->
    <div class="ui main container">
        [[*content]]
    </div>
    
    <!-- Footer -->
    [[$thematicFooter]]
    
</body>
</html>
