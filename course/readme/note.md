## Color Code 色票
1. 沉穩灰: #eeeded
2. 活力紅: #e14040
3. 翡翠綠: #2addc7
4. ...

###### 提問：顔色名稱待議 

## 檔案及資料匣架構 構想(待表決)
1. 依「功能」分資料匣，例如：
    1. root > course > data_list.php
    2. root > route > data_list.php
    3. 以此類推
    
2. 檔案直接放根目錄，例如：
    1. root > course_list.php
    2. root > route_list.php
    3. 以此類推
    
3. 綜合上述兩種模式，例如：
    1. root > course > course_list.php
    2. root > route > route_list.php
    3. 以此類推

## 「樣式表(.css)」及「腳本(.js)」 放置位置(待表決)
1. 樣式表放置於「stylesheets」資料匣；腳本放置於「scripts」資料匣，例如：

    1. root > stylesheets > myStyleSheet.css
    2. root > scripts > utility.js
    3. 以此類推
    ###### 提問：「stylesheets」或「css」？
    ###### 提問：「scripts」或「javascript」？
    ###### 提問：需不需要加「s」？

## 「插件」的放置位置(待表決)
1. 放置於「plugins」資料匣底下，依建立插件的資料匣，例如：
    1. root > plugins > bootstrap > css > bootstrap.css
    2. root > plugins > bootstrap > js > bootstrap.js
    3. root > plugins > ckeditor > ckeditor.js
    4. 以此類推
    
2. 若插件只有一個檔案(例如：jQuery)，則直接置於「plugins」資料匣底下，例如：
    1. root > plugins > jquery-3.3.1.js
    2. root > plugins > underscore.js
    3. 以此類推
    
## 「頁面用圖檔」之放置位置(待表決)
1. 放置於「images」資料匣
2. 其他

## 「上傳的圖檔」之放置位置(待表決)
1. 放置於「upload_img」資料匣
2. 其他


## 「html」分割之檔案(例如：__navbar.php)之放置位置？(待表決)
1. 根目錄
2. 放置於「html_parts」資料匣
3. 其他

## 是否設置一個「trash_can」資源回收桶資料匣放置「不忍心直接刪掉的檔案」？(待表決)
1. 是
2. 否
3. 其他

## Git推送的commit訊息，前面加上英文字母代號(英文名字第一個字母)，方便辨認，例如：
1. W: 表格更新
2. V: navbar樣式修改
3. 以此類推

##### 代號對照表： 
| 代號 | 英文名字 | 姓名 |
|------|----------|--------|
| A | Allen | 王竣麟 |
| C | Clifford | 田仲展 |
| I | Ivy | 張涓悅 |
| L | Leo | 蔡承恩 |
| V | Vince | 廖政宇 |
| W | Woody | 張皓涵 |
  
    
