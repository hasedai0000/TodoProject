import { TodoType } from '@/interfaces/Todo';
import { AxiosResponse } from 'axios';
import globalAxios, { IErrorResponse, isAxiosError, ResponseType } from './config';

/**
 * Todo一覧
 * @returns Todo一覧
 */
export const fetchTodoListApi = async () => {
  try {
    const { data }: AxiosResponse<TodoType[]> = await globalAxios.get('/todos');
    const res: ResponseType<TodoType[]> = {
      success: true,
      data: data.data.todos,
      message: 'Todo一覧を取得しました',
    };
    return res;
  } catch (error) {
    const res: ResponseType = {
      success: false,
      message: 'Todo一覧を取得できませんでした',
    };
    if (isAxiosError(error)) {
      const axiosError = error as IErrorResponse;
      res.message = axiosError.response?.data.message;
    }
    return res;
  }
};
