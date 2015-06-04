//
//  Database.h
//  CheckParking
//
//  Created by e125719 on 2015/06/04.
//  Copyright (c) 2015年 Takahiro NAGAKURA. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface Database : NSObject

- (instancetype)initWithDatabaseFilename:(NSString *)dbFilename;

@property(nonatomic, strong) NSString *documentsDirectory;
@property(nonatomic, strong) NSString *databaseFilename;

@property(nonatomic, strong) NSMutableArray *arrResults;

- (void)runQuery:(const char *)query isQueryExecutable:(BOOL)queryExecutable;

@property(nonatomic, strong) NSMutableArray *arrColumnNames;
@property(nonatomic) int affectedRows;
@property(nonatomic) long long lastInsertedRowID;

@end
