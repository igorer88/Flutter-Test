import 'package:flutter/material.dart';
import 'package:news_app_mobile/screens/categories_list.dart';
import 'screens/home_screen.dart';


  void main(){
    runApp(NewsApp());
  }

class NewsApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
          primaryColor: Colors.purple
      ),
      //home: HomeScreen(),
      routes: {
          '/' :(BuildContext context) => HomeScreen(),
          '/categories' :(BuildContext context) => Categories(),
      }
    );
  }
}
