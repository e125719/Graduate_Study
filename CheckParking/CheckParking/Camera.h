//
//  Camera.h
//  CheckParking
//
//  Created by e125719 on 2015/06/03.
//  Copyright (c) 2015年 Takahiro NAGAKURA. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface Camera : UIViewController <UINavigationControllerDelegate, UIImagePickerControllerDelegate> {
    UIImageView* _imageView;
}

@end
