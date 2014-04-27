jQuery(document).ready(function ($) {
    $("#upload_logo").click( function (event) {
        var myUploadFrame=false;
		console.log('yey')
        event.preventDefault(); // we don't want other actions to trigger like having # sign appending on the url
        if (myUploadFrame) { // open if the frame is already constructed
            myUploadFrame.open();
            return;
        }
        myUploadFrame = wp.media.frames.my_upload_frame = wp.media({
            frame: "select", // either post or select
            title: "Upload Logo", // title for the uploader frame
            library: {
                type: "image"
            },
            button: {
                text: "Set as Logo", // text for button
            },
            multiple: false // Set to true if you be able to select multiple images
        });
        myUploadFrame.on("select", function () { // callback when image is selected
            var selection = myUploadFrame.state().get("selection"); // get the selected image object
            selection.map(function (attachment) {
                attachment = attachment.toJSON(); // convert to usable object notation
                if (attachment.id) {
                    // use the image object the way you want now. do console.log(attachment) to know what object you are getting and you can use them
                    var newLogoID = attachment.id; // get the attachment id
                    var logoMediumImageSize = attachment.sizes.medium.url; // get the medium size image
 
                    // Now lets put everything together
                    $("#logo_image_id").val(newLogoID);
                    var newLogoImage = $("<img>").attr({
                        src: logoMediumImageSize
                    });
                    $("#logo_image_holder").empty().append(newLogoImage);
                }
            });
        });
myUploadFrame.open();
    });
});

