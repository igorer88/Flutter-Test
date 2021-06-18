import 'author.dart';
class PostComment{

  String comment_id, comment, post_id;
  Author author;


  PostComment(this.comment_id, this.comment, this.post_id, this.author);

  PostComment.fromJson(Map<String,dynamic> jsonObject){
    this.comment_id=jsonObject['comment_id'].toString();
    this.comment=jsonObject['content'].toString();
    this.post_id=jsonObject['post_id'].toString();
    this.author=Author.fromJson(jsonObject['author']);
  }

}