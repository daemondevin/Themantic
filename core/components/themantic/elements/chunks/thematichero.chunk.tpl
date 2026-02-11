<div class="ui inverted vertical masthead center aligned segment">
    <div class="ui text container">
        <h1 class="ui inverted header">
            [[*heroHeading:default=`[[*pagetitle]]`]]
        </h1>
        <h2>[[*heroSubheading:default=`Welcome to our website`]]</h2>
        <div class="ui huge primary button">
            [[*heroCTAText:default=`Get Started`]]
            <i class="right arrow icon"></i>
        </div>
    </div>
</div>

<style>
.masthead {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 500px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    [[*heroBackgroundImage:notempty=`
        background-image: url('[[*heroBackgroundImage]]');
        background-size: cover;
        background-position: center;
    `]]
}

.masthead h1.ui.header {
    margin-top: 2em;
    margin-bottom: 0;
    font-size: 4em;
    font-weight: normal;
}

.masthead h2 {
    font-size: 1.7em;
    font-weight: normal;
    margin-top: 1.5em;
}
</style>
