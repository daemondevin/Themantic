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
<body class="landing-page">
    
    <!-- Navigation -->
    [[$thematicNavigation]]
    
    <!-- Hero Section -->
    [[$thematicHero]]
    
    <!-- Main Content -->
    <div class="ui vertical stripe segment">
        <div class="ui middle aligned stackable grid container">
            [[*content]]
        </div>
    </div>
    
    <!-- Features Section -->
    <div class="ui vertical stripe segment">
        <div class="ui text container">
            <h3 class="ui header">[[*featuresHeading:default=`Features`]]</h3>
            <div class="ui three column stackable grid">
                [[*featuresContent]]
            </div>
        </div>
    </div>
    
    <!-- CTA Section -->
    <div class="ui vertical stripe segment">
        <div class="ui text container">
            [[*ctaContent]]
        </div>
    </div>
    
    <!-- Footer -->
    [[$thematicFooter]]
    
</body>
</html>
