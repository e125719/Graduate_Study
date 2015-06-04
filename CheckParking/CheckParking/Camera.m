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

- (void)imagePickerControllerDidCancel:(UIImagePickerController *)pickerCtl {
    // If canceled, close the picker view's view.
    [[pickerCtl presentingViewController] dismissViewControllerAnimated:YES completion:nil];
}

- (void)viewDidLoad {
    [super viewDidLoad];
    
    // Make "Camera" button.
    UIButton* btnCamera = [self makeButton:CGRectMake(60, 20, 200, 40) text:@"Camera" tag:BTN_CAMERA];
    [self.view addSubview:btnCamera];
    
    // Make "Load Photos" button.
    UIButton* btnRead = [self makeButton:CGRectMake(60, 70, 200, 40) text:@"Load Photos" tag:BTN_READ];
    [self.view addSubview:btnRead];
    
    // Make "Write Photos" button.
    UIButton* btnWrite = [self makeButton:CGRectMake(60, 120, 200, 40) text:@"Write Photos" tag:BTN_WRITE];
    [self.view addSubview:btnWrite];
    
    // Make image view.
    _imageView = [self makeImageView:CGRectMake(60, 190, 200, 200) image:nil];
    [self.view addSubview:_imageView];
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

- (void)finishExport:(UIImage *)image didFinishSavingWithError:(NSError *)error contextInfo:(void *)contextInfo {
    // Finished writing the photo.
    if (error == nil) {
        [self showAlert:@"" text:@"Finished Writing the Photo"];
    } else {
        [self showAlert:@"" text:@"Failed Writing the Photo"];
    }
}

@end
