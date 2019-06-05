## 課程集資 資料表架構
### course 資料表
- [x] c_sid 課程ID
- 課程內容
    - [x] c_title 課程名稱(rename)
    - [x] c_subtitle 課程副標題
    - [x] c_intro 課程內容
    - [x] c_cover 課程封面照片(rename)
    - [x] c_level 課程難度
    - [x] c_courseDate 開課時間
    - [x] c_courseLocation 上課地點
    - [ ] c_courseUpdate 課程更新
    - [ ] c_courseComment
    - [ ] c_courseQandA
-教練資訊
    - [x] c_coachName 教練姓名(rename)
    - [x] c_coachAvatar 教練頭像(rename)
    - [x] c_coachNationality 教練國籍
    - [ ] c_coachInfo 教練簡介
- 集資資訊
    - [x] c_backers 贊助人數
    - [x] c_fundNow 目前集資金額
    - [x] c_fundGoal 目標集資金額
    - [x] c_createDate 資料建立日期
    - [x] c_startDate 集資開始日期
    - [x] c_endDate 集資截止日期
    - [x] c_status 集資狀態

### 待確認
- 集資人數
    - 從於會員的資料表拿去
    - c_backers 集資人數