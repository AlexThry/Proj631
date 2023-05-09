package Java;

import java.sql.*;
import java.util.ArrayList;

public class ConnectionDatabase {

    public ConnectionDatabase() {
    }

    public Connection connect() {
        try {
            //étape 1: charger la classe de driver
            Class.forName("com.mysql.jdbc.Driver");
            //étape 2: créer l'objet de connexion
            Connection conn = DriverManager.getConnection(
                    "jdbc:mysql://localhost:3306/proj631?characterEncoding=utf8", "root", "");
            return conn;
        } catch (Exception e) {
            System.out.println(e);
        }

        return null;
    }

    public void insert(String query, Connection conn){
        try {
            //étape 3: créer l'objet statement
            Statement stmt = conn.createStatement();
            stmt.executeUpdate(query);
            System.out.println("la requète "+query+" est valide");
        }catch (Exception e){
            System.out.println(e);
        }
    }
    public ArrayList<String> selectList(String query, Connection conn, String colonne){
        ArrayList<String> tab= new ArrayList<String>();
        // créer l'objet statement
        try{
            Statement stmt = conn.createStatement();
            ResultSet res = stmt.executeQuery(query);
            int i =0;
            while(res.next()){
                //Récupérer par nom de colonne
                tab.add(res.getString(colonne));
                i+=1;
            }
        }catch (Exception e){
            System.out.println(e);
        }
        return tab;

    }
    public void delete(String query, Connection conn){
        try{
        Statement stmt = conn.createStatement();
        stmt.executeUpdate(query);
        System.out.println("Suppression...");}
        catch (Exception e){
            System.out.println(e);
        }
    }
    public void closeConnect(Connection conn){
        try{
            //étape 5: fermez l'objet de connexion
            conn.close();
        }catch (Exception e){
            System.out.println(e);
        }
    }



}

