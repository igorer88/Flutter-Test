class PostVideo{

  String video_id, video_title, video_url, post_id;

  PostVideo(this.video_id, this.video_title, this.video_url, this.post_id);

  PostVideo.fromJson(Map<String,dynamic> jsonObject){
    this.video_id=jsonObject['video_id'].toString();
    this.video_title=jsonObject['video_title'].toString();
    this.video_url=jsonObject['video_url'].toString();
    this.post_id=jsonObject['post_id'].toString();
  }


}