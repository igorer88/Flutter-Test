class Util{

  static List<Object> LOADING_DATA(List<dynamic> jsonObject,var Object, List<Object> images){
      for (var item in jsonObject){
        images.add(Object.fromJson(item));
      }
      return images;
  }
}