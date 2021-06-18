import 'post_comment.dart';
import 'post_video.dart';
import 'post_image.dart';
import 'category.dart';
import 'post_tag.dart';
import 'author.dart';
import 'package:news_app_mobile/util/util.dart';
class Post{

  String post_id, post_title, post_content, post_type, updated_at;
  Author author;
  List<PostTag> tags;
  Category category;
  List<PostVideo> videos;
  List<PostImage> images;
  List<PostComment> comments;


  Post(this.post_id, this.post_title, this.post_content, this.post_type,
      this.updated_at, this.author, this.tags, this.category, this.videos,
      this.images, this.comments);

  Post.fromJson(Map<String,dynamic> jsonObject){
    this.post_id=jsonObject['post_id'].toString();
    this.post_title=jsonObject['post_title'].toString();
    this.post_content=jsonObject['post_content'].toString();
    this.post_type=jsonObject['post_type'].toString();
    this.updated_at=jsonObject['updated_at'].toString();

    this.author=Author.fromJson(jsonObject['author']);

    this.category=Category.fromJson(jsonObject['category']);

    this.images=[];

    for (var item in jsonObject['images']){
      images.add(PostImage.fromJson(item));
    }

    this.tags=[];

    for (var item in jsonObject['tags']){
      tags.add(PostTag.fromJson(item));
    }

    this.videos=[];

    for (var item in jsonObject['videos']){
      videos.add(PostVideo.fromJson(item));
    }

    this.comments=[];

    for (var item in jsonObject['comments']){
      comments.add(PostComment.fromJson(item));
    }

  }


}