package ch.rm2014.vogler;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {

	private static Database instance;

	private Connection connection;

	private Database() {

	}

	public Connection getConnection() throws SQLException,
			ClassNotFoundException {

		if (connection == null) {

			Class.forName("com.mysql.jdbc.Driver");

			connection = DriverManager.getConnection(
					"jdbc:mysql://localhost:3306/rm2014", "root", "");
		}

		return connection;
	}

	public static Database getInstance() {
		if (instance == null) {
			instance = new Database();
		}
		return instance;
	}
}
