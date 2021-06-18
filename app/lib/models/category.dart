class Category{

  String id, category, color;

  Category(this.id, this.category, this.color);

  Category.fromJson(Map<String,dynamic> jsonObject){
    this.id=jsonObject['category_id'].toString();
    this.category=jsonObject['category_title'].toString();
    this.color=jsonObject['category_color'].toString();
  }




}