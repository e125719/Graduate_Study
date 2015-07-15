//
//  MySQL.m
//  CheckParking
//
//  Created by e125719 on 2015/07/13.
//  Copyright (c) 2015年 Takahiro NAGAKURA. All rights reserved.
//

#import "MySQL.h"

@implementation connectMySQL

- (void)viewDidLoad {
    [super viewDidLoad];
    
    usrArr = [[NSMutableArray alloc] init];
    xml_index = 0;
    
    NSString *url = @"";
    
    NSURL *pageURL = [NSURL URLWithString:url];
    NSXMLParser *pageParser = [[NSXMLParser alloc] initWithContentsOfURL:pageURL];
    pageParser.delegate = self;
    
    [pageParser parse];
}

- (void)parserDidStartDocument:(NSXMLParser *)parser {
    tagStr = @"";
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    if ([tagStr isEqualToString:@"user"]) {
        tagStr = [NSString stringWithString:elementName];
        txtBuffer = @"";
    }
}

- (void)parser:(NSXMLParser *)parser foundCharacters:(NSString *)string {
    if ([tagStr isEqualToString:@"user"]) {
        txtBuffer = [txtBuffer stringByAppendingString:string];
    }
}

- (void)parser:(NSXMLParser *)parser didEndElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName {
    if ([tagStr isEqualToString:@"user"]) {
        NSString *xml_name = txtBuffer;
        
        [usrArr insertObject:xml_name atIndex:xml_index];
        xml_index++;
    }
}

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView {
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    return [usrArr count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    static NSString *cellIdentifier = @"Cell";
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:cellIdentifier];
    
    if (cell == nil) {
        cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:cellIdentifier];
    }
    
    cell.textLabel.text = [usrArr objectAtIndex:indexPath.row];
    
    return cell;
}

@end
