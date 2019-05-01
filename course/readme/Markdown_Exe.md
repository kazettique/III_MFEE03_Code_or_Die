這是MarkDown的練習！！

# Let's practice how to write markdown!!!
~~~
**This is a bold text.**
~~~
**This is a bold text.**

# I am Heading1
## I am Heading2
### I am Heading3
#### I am Heading4
##### I am Heading5
###### I am Heading6
~~~
*I am italic*
~~~
*I am italic*
~~~
***Bold and italic***
~~~
***Bold and italic***
~~~
> I think therefore I am.
~~~
> I think therefore I am.

### The Ordered Lists

#### Grocery Buy List
~~~
1. Milk
~~~
1. Milk
2. Coke
3. Bread
4. Vegetable
5. Cereal


### The Unordered Lists

#### Grocery Buy List
~~~
- Milk
~~~
- Milk
- Coke
- Bread
- Vegetable
- Cereal

~~~
<html>
  <head> 
    <title>Test</title>
    
  </head>
</html>
<script>
for(let i=0; i<10; i++) {
  console.log(i);
}
</script>
~~~
```css
    <style>
      .main {
        background: blue;
      }
    </style>
```
```js
for(let i=0; i<10; i++) {
  console.log(i);
}
```
```php
<?php
  $num = 1;
  echo "hello world";
?>
```

#### Code
~~~
At the command prompt, type `nano`.
~~~
At the command prompt, type `nano`.


#### Escaping Tick Marks
``Use `code` in your Markdown file.``

#### Horizontal Rules
- \*\*\*
***
- \-\-\-
---
- \-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-
-----------------

#### Links
My favorite search engine is [Duck Duck Go](https://duckduckgo.com).
Go to [Apple](http://apple.com)

#### URLs and Email Addresses
<https://www.markdownguide.org>
<fake@example.com>
<hello@gmail.com>

#### Formatting Links
I love supporting **[EFF](https://eff.org)**.
This is the *[Markdown Guide](https://www.markdownguide.org)*.

#### Images
![Philadelphia's Magic Gardens. This place was so cool!](/assets/images/philly-magic-gardens.jpg "Philadelphia's Magic Gardens")

#### Linking Images
[![An old rock in the desert](/assets/images/shiprock.jpg "Shiprock, New Mexico by Beau Rogers")](https://www.flickr.com/photos/beaurogers/31833779864/in/photolist-Qv3rFw-34mt9F-a9Cmfy-5Ha3Zi-9msKdv-o3hgjr-hWpUte-4WMsJ1-KUQ8N-deshUb-vssBD-6CQci6-8AFCiD-zsJWT-nNfsgB-dPDwZJ-bn9JGn-5HtSXY-6CUhAL-a4UTXB-ugPum-KUPSo-fBLNm-6CUmpy-4WMsc9-8a7D3T-83KJev-6CQ2bK-nNusHJ-a78rQH-nw3NvT-7aq2qf-8wwBso-3nNceh-ugSKP-4mh4kh-bbeeqH-a7biME-q3PtTf-brFpgb-cg38zw-bXMZc-nJPELD-f58Lmo-bXMYG-bz8AAi-bxNtNT-bXMYi-bXMY6-bXMYv)

#### Escaping Characters
\* Without the backslash, this would be a bullet in an unordered list.

#### Characters You Can Escape
- \\    backslash <br>
- \`    tick mark <br>
- \*    asterisk <br>
- \_    underscore <br>
- \{\}  curly braces <br>
- \[\]  brackets <br>
- \(\)  parentheses <br>
- \#    pound sign <br>
- \+    plus sign <br>
- \-    minus sign <br>
- \.    dot <br>
- \!    exclamation mark <br>

#### Heading IDs
~~~
### My Great Heading {#custom-id}
~~~

#### Linking to Heading IDs
~~~
[Heading IDs](#heading-ids)
~~~
[To top](#top)

#### Strikethrough
~~~
~~The world is flat.~~ We now know that the world is round.
~~~
~~The world is flat.~~ We now know that the world is round.

#### Tasks List
~~~
- [x] Write the press release
- [ ] Update the website
- [ ] Contact the media
~~~
- [x] Write the press release
- [ ] Update the website
- [ ] Contact the media


#### Automatic URL Linking
http://example.com

#### Disabling Automatic URL Linking
~~~
`http://www.example.com`
~~~
`http://www.example.com`

#### 目錄製作練習
以下列範例內容示範如何生成目錄：
```markdown
### 這是H3
我是文章片段
## 這是H2
我是文章片段
## 這也是H2科科
我是文章片段
### 偶是H3啦啦啦
我是文章片段
### 包含`hello`程式片段的H3
我是文章片段
```
1. 將MD所有欲生成目錄的內容複製並貼於[此網頁](https://ecotrust-canada.github.io/markdown-toc/)左側的欄位，按下`convert`按鈕，複製右方生成的目錄原始碼
2. 生成的標題(header)若有中文字，則目錄原始碼會出現以下的結果：
```markdown
### 目錄
  * [這是H3](#--h3)
- [這是H2](#--h2)
- [這也是H2科科](#---h2--)
  * [偶是H3啦啦啦](#--h3---)
  * [包含`hello`程式片段的H3](#---hello------h3)
```
3. 中文字因為網站問題直接轉換成`-`(dash)，將`-`用中文字**依序取代**之後就可以正常使用了
4. 值得注意的是，若header的內容有包含程式片段，例如最後一個標題：
```markdown
### 包含`hello`程式片段的H3
```
5. 目錄連結的部分(**小括號**裡面的內容)，記得後面ID的部分要把程式片段兩側的``去掉，寫成：
```markdown
* [包含`hello`程式片段的H3](#包含hello程式片段的h3)
```
6. 修改後的目錄原始碼，如下：
```markdown
### 目錄
  * [這是H3](#這是h3)
- [這是H2](#這是h2)
- [這也是H2科科](#這也是h2科科)
  * [偶是H3啦啦啦](#偶是h3啦啦啦)
  * [包含`hello`程式片段的H3](#包含hello程式片段的h3)
```
7. 以下為測試區域：

---

### 目錄
  * [這是H3](#這是h3)
- [這是H2](#這是h2)
- [這也是H2科科](#這也是h2科科)
  * [偶是H3啦啦啦](#偶是h3啦啦啦)
  * [包含`hello`程式片段的H3](#包含hello程式片段的h3)

### 這是H3
我是文章片段
## 這是H2
我是文章片段
## 這也是H2科科
我是文章片段
### 偶是H3啦啦啦
我是文章片段
### 包含`hello`程式片段的H3
我是文章片段

---