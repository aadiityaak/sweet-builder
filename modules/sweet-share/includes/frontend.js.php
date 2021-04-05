(function( $ ){
    console.log(".sweet-share-<?php echo $id; ?> .share-content");
    $(".sweet-share-<?php echo $id; ?> .share-content").jsSocials({
        showCount: false,
        showLabel: true,
        shares: [
            "email",
            "twitter",
            "facebook",
            "googleplus",
            "linkedin",
            { share: "pinterest", label: "Pin this" },
            "stumbleupon",
            "whatsapp"
        ]
    });
});