class PostImage{

  String image_id, image_description, image_url, post_id, image_featured;


  PostImage(this.image_id, this.image_description, this.image_url, this.post_id,
      this.image_featured);

  PostImage.fromJson(Map<String,dynamic> jsonObject){
    this.image_id=jsonObject['image_id'].toString();
    this.image_description=jsonObject['image_description'].toString();
    this.image_url=jsonObject['image_url'].toString();
    this.image_featured=jsonObject['image_featured'].toString();
    this.post_id=jsonObject['post_id'].toString();
  }


}