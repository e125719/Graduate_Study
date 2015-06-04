//
//  Camera.m
//  CheckParking
//
//  Created by e125719 on 2015/06/03.
//  Copyright (c) 2015年 Takahiro NAGAKURA. All rights reserved.
//

#import "Camera.h"

#define BTN_CAMERA  0
#define BTN_READ    1
#define BTN_WRITE   2

@implementation Camera

- (void)showAlert:(NSString *)title text:(NSString *)text {
    // Show alert.
    UIAlertView* alert = [[UIAlertView alloc] initWithTitle:title message:text delegate:nil cancelButtonTitle:@"OK" otherButtonTitles:nil];
    [alert show];
}

- (UIButton *)makeButton:(CGRect)rect text:(NSString *)text tag:(int)tag {
    // Make text button.
    UIButton* button = [UIButton buttonWithType:UIButtonTypeRoundedRect];
    [button setTitle:text forState:UIControlStateNormal];
    [button setFrame:rect];
    [button setTag:tag];
    [button addTarget:self action:@selector(clickButton:) forControlEvents:UIControlEventTouchUpInside];

    return button;
}

- (UIImageView *)makeImageView:(CGRect)rect image:(UIImage *)image {
    // Show taked photos.
    UIImageView* imageView = [[UIImageView alloc] init];
    [imageView setFrame:rect];
    [imageView setImage:image];
    [imageView setContentMode:UIViewContentModeScaleAspectFit];
    
    return imageView;
}

- (void)openPicker:(UIImagePickerControllerSourceType)sourceType {
    // Check you can use camera and photo album.
    if (![UIImagePickerController isSourceTypeAvailable:sourceType]) {
        [self showAlert:@"" text:@"You cannot use the camera and photo album."];
        return;
    }
    
    // Initialize image picker.
    UIImagePickerController* picker = [[UIImagePickerController alloc] init];
    picker.sourceType = sourceType;
    picker.delegate = self;
    
    // Open the view controller's view.
    if ([[UIDevice currentDevice].model rangeOfString:@"iPad"].location == NSNotFound) {
        [self presentViewController:picker animated:YES completion:nil];
    } else {
        UIButton* button = [[self.view subviews] objectAtIndex:1];
        UIPopoverController* popoverCtl = [[UIPopoverController alloc] initWithContentViewController:picker];
        
        [popoverCtl presentPopoverFromRect:[button bounds] inView:button permittedArrowDirections:UIPopoverArrowDirectionAny animated:YES];
    }
}

- (void)imagePickerController:(UIImagePickerController *)picker didFinishPickingMediaWithInfo:(NSDictionary *)info {
    // Specify images.
    UIImage* image = [info objectForKey:UIImagePickerControllerOriginalImage];
    [_imageView setImage:image];
    
    // Close the picker view's view.
    [[picker presentingViewController] dismissViewControllerAnimated:YES completion:nil];
}

- (IBAction)clickButton:(UIButton *)sender {
    // Button clicked events.
    if (sender.tag == BTN_CAMERA) {
        [self openPicker:UIImagePickerControllerSourceTypeCamera];
    } else if (sender.tag == BTN_READ) {
        [self openPicker:UIImagePickerControllerSourceTypePhotoLibrary];
    } else if (sender.tag == BTN_WRITE) {
        UIImage* image = [_imageView image];
        
        if (image == nil) return;
        
        // Save the taked photo
        UIImageWriteToSavedPhotosAlbum(image, self, @selector(finishExport:didFinishSavingWithError:contextInfo:), NULL);
    }
}

@end
