package ch.rm2014.vogler;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/tag")
public class AddTagServlet extends HttpServlet {

	private static final long serialVersionUID = 1L;

	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			int idThread = Integer.parseInt(request.getParameter("id_thread"));
			String tag = request.getParameter("tag");
			tag = tag.toLowerCase();

			PreparedStatement statement = connection
					.prepareStatement("SELECT id_tag FROM tag WHERE name_tag = ?");
			statement.setInt(1, idThread);
			statement.execute();

			ResultSet resultSet = statement.getResultSet();

			int idTag;
			if (resultSet.next()) {

				idTag = resultSet.getInt(1);

			} else {

				statement = connection.prepareStatement(
						"INSERT INTO tag (name_tag) VALUES (?)",
						Statement.RETURN_GENERATED_KEYS);
				statement.setString(1, tag);
				statement.execute();

				ResultSet rs = statement.getGeneratedKeys();
				rs.next();
				idTag = rs.getInt(1);
			}

			statement = connection
					.prepareStatement("INSERT INTO thread_tag (id_thread, id_tag) VALUES (?, ?");
			statement.setInt(1, idThread);
			statement.setInt(2, idTag);
			statement.execute();

			response.sendRedirect("thread_detail?id=" + idThread);

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
