package ch.rm2014.vogler;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Comment {

	private int idThread = 0;

	private String nameThread = "";

	private String nameAuthor = "";

	private String content = "";

	private int ratingUp = 0;

	private int ratingDown = 0;

	public int getIdThread() {
		return idThread;
	}

	public String getNameThread() {
		return nameThread;
	}

	public String getNameAuthor() {
		return nameAuthor;
	}

	public String getContent() {
		return content;
	}

	public int getRatingUp() {
		return ratingUp;
	}

	public int getRatingDown() {
		return ratingDown;
	}

	public static Comment create(ResultSet resultSet) throws SQLException {
		Comment thread = new Comment();
		thread.idThread = resultSet.getInt("id_thread");
		thread.nameAuthor = resultSet.getString("name_author");
		thread.nameThread = resultSet.getString("name_thread");
		thread.content = resultSet.getString("content");
		thread.ratingUp = resultSet.getInt("rating_up");
		thread.ratingDown = resultSet.getInt("rating_down");
		return thread;
	}
}
