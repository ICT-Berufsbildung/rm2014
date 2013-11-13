package ch.rm2014.vogler;

import java.io.IOException;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/home")
public class HomeServlet extends HttpServlet {

	private static final long serialVersionUID = 1L;

	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			Statement statement = connection.createStatement();
			ResultSet resultSet = statement
					.executeQuery(""
							+ "SELECT t.id_thread, t.name_thread, c.content, c.rating_up, c.rating_down, c.rating_up - c.rating_down AS rating "
							+ "FROM thread t INNER JOIN comment c ON c.id_thread = t.id_thread GROUP BY t.id_thread ORDER BY rating DESC LIMIT 1");

			resultSet.next();

			Thread thread = Thread.create(resultSet);

			request.setAttribute("thread", thread);

			getServletContext().getRequestDispatcher("/WEB-INF/jsps/home.jsp")
					.forward(request, response);

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
