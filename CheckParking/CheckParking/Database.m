//
//  Database.m
//  CheckParking
//
//  Created by e125719 on 2015/06/04.
//  Copyright (c) 2015年 Takahiro NAGAKURA. All rights reserved.
//

#import "Database.h"
#import <sqlite3.h>

@implementation Database

- (instancetype)initWithDatabaseFilename:(NSString *)dbFilename {
    self = [super init];
    if (self) {
        // Set the documents directory path to the DocumentsDirectory property.
        NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentationDirectory, NSUserDomainMask, YES);
        self.documentsDirectory = [paths objectAtIndex:0];
        
        // Keep the database filename.
        self.databaseFilename = dbFilename;
        
        // Copy the database file into the documents directory if necessary.
        [self copyDatabaseintoDocumentsDirectory];
    }
    return self;
}

@end
