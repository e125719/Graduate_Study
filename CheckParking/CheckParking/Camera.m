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
    UIAlertView* alert = [[UIAlertView alloc] initWithTitle:title message:text delegate:nil cancelButtonTitle:@"OK" otherButtonTitles:nil];
    
    [alert show];
}

@end
