//
//  MySQL.h
//  CheckParking
//
//  Created by e125719 on 2015/07/13.
//  Copyright (c) 2015年 Takahiro NAGAKURA. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface connectMySQL : UITableViewController<NSXMLParserDelegate> {
    NSString *tagStr;
    NSString *txtBuffer;
    
    NSMutableArray *usrArr;
    NSInteger xml_index;
}

@end
